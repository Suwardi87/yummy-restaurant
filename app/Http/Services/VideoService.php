<?php

namespace App\Http\Services;

use Illuminate\Support\Str;
use App\Models\Galerry\Video;

class VideoService
{
    public function select($paginate = null){
        return Video::latest()->paginate($paginate);
    }

    public function getByid(string $id)
    {
       return Video::where('uuid', $id)->firstOrFail();

    }
    public function create($data){
        $video = [
            'slug' => Str::slug($data['name']),
            'video_link' => $this->formatVideoLink($data['video_link']),
        ];
        return Video::create(array_merge($data, $video));
    }

    private function formatVideoLink($url)
    {
        // Misal link input: https://www.youtube.com/watch?v=T1TR-RGf2Pw
        // Output akan jadi: https://www.youtube.com/embed/T1TR-RGf2Pw

        // Mengambil ID video dari link
        if (preg_match('/(?:\?v=|\/embed\/|\/\d+\/|\/v\/|youtu\.be\/|\/e\/|watch\?v=|&v=)([^&\n?#]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return $url; // Jika format tidak cocok, kembalikan link asli
    }
    public function update($data, string $id){
        $data['slug'] = Str::slug($data['name']);
        return Video::where('uuid', $id)->update($data);
    }
}