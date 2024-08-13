<?php

namespace App\Http\Controllers;

use App\Charts\TugasLaporChart;
use App\Models\Peta;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    public function dashboard(TugasLaporChart $tugasLaporChart)
    {
        // Hitung total data
        $totalPosts = Post::count();
        // Hitung persentase laporan akhir yang sudah dikumpulkan dari semua data
        $submittedLaporanAkhir = Post::whereNotNull('laporan_akhir')->count();
        $laporanAkhirRate = $totalPosts > 0 ? ($submittedLaporanAkhir / $totalPosts) * 100 : 0;

        // Query untuk anggota yang ditugaskan
        $user = Auth::user();
        $assignedPostsQuery = Post::where(function ($query) use ($user) {
            $query->where('tanggungjawab', $user->name)
                ->orWhere('anggota', 'LIKE', '%' . $user->name . '%');
        });

        // Ambil data anggota yang ditugaskan
        $assignedPosts = $assignedPostsQuery->get();

        // Ambil semua post untuk super admin dan admin
        $allPosts = collect([]);
        if ($user->id_level == 1 || $user->id_level == 2) {
            $allPosts = Post::all();
        }

        // Hitung persentase laporan akhir untuk data yang ditugaskan
        $submittedLaporanAkhirAssigned = $assignedPostsQuery->whereNotNull('laporan_akhir')->count();
        $laporanAkhirRateAssigned = $assignedPosts->isNotEmpty() ? ($submittedLaporanAkhirAssigned / $assignedPosts->count()) * 100 : 0;

        // Hitung data yang di-approve oleh ketua
        // $approvedPosts = Post::whereNotNull('approvalReviu')
        //                      ->orWhereNotNull('approvalBerita')
        //                      ->orWhereNotNull('approvalPengesahan')
        //                      ->orWhereNotNull('approvalRubrik')
        //                      ->count();

        // // Hitung persentase data yang di-approve
        // $approvalRate = $totalPosts > 0 ? ($approvedPosts / $totalPosts) * 100 : 0;

        // Hitung jumlah data sesuai dengan bidang
        $bidangCounts = Post::select('bidang', \DB::raw('count(*) as total'))
            ->groupBy('bidang')
            ->pluck('total', 'bidang')
            ->toArray();

        return view('dashboard', [
            'tugasLaporChart' => $tugasLaporChart->build(),
            // 'approvalRate' => $approvalRate,
            'laporanAkhirRate' => $laporanAkhirRate,
            'laporanAkhirRateAssigned' => $laporanAkhirRateAssigned,
            'assignedPosts' => $assignedPosts,
            'allPosts' => $allPosts,
            'bidangCounts' => $bidangCounts,
            'user' => Auth::user(),
        ]);
    }

    public function template()
    {
        // Path folder dokumen di dalam public
        $folderPath = ('all_template/');

        // Ambil semua file dari folder dokumen
        $files = File::files($folderPath);

        // Format data file
        $filesData = collect($files)->map(function ($file) {
            return [
                'name' => basename($file),
                'path' => 'all_template/' . basename($file),
            ];
        });

        return view('template', ['files' => $filesData]);
    }


    public function search(Request $request)
    {
        $search = $request->input('search');
        $posts = Post::where('judul', 'like', '%' . $search . '%')
            ->orWhere('deskripsi', 'like', '%' . $search . '%')
            ->orWhere('waktu', 'like', '%' . $search . '%')
            ->orWhere('tanggungjawab', 'LIKE', '%' . $search . '%')
            ->orWhere('anggota', 'LIKE', '%' . $search . '%')
            ->paginate(10);

        return view('posts.reviewLaporan', compact('posts'));
    }
    public function searchKetua(Request $request)
    {
        $search = $request->input('search');
        $posts = Post::where('judul', 'like', '%' . $search . '%')
            ->orWhere('deskripsi', 'like', '%' . $search . '%')
            ->orWhere('waktu', 'like', '%' . $search . '%')
            ->orWhere('tanggungjawab', 'like', '%' . $search . '%')
            ->paginate(10);

        return view('posts.reviewLaporanKetua', compact('posts'));
    }
    public function searchAkhir(Request $request)
    {
        $search = $request->input('search');
        $posts = Post::whereNotNull('laporan_akhir') //filter yang telah upload laporan akhir
            ->where(function ($query) use ($search) {
                $query->where('judul', 'LIKE', '%' . $search . '%')
                    ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
            })
            ->paginate(10);
        return view('posts.laporanAkhir', compact('posts'));
    }
    public function searchTindakLanjut(Request $request)
    {
        $search = $request->input('search');
        $posts = Post::whereNotNull('dokumen_tindak_lanjut') //filter yang telah upload tindak lanjut
            ->where(function ($query) use ($search) {
                $query->where('judul_tindak_lanjut', 'LIKE', '%' . $search . '%');
            })
            ->paginate(10);
        return view('posts.dokumen_tindakLanjut', compact('posts'));
    }

    public function feedback()
    {
        return view('feedback');
    }
    public function feedback_web()
    {
        return view('feedback');
    }
}
