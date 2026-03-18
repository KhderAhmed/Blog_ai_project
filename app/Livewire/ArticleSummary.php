<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;

class ArticleSummary extends Component
{
    public $blogId;
    public $summary = '';

    public function generateSummary()
    {
        $blog = Article::find($this->blogId);

        // تحقق من وجود المقال ومحتواه
        if (!$blog || empty(trim(strip_tags($blog->content)))) {
            $this->summary = 'المحتوى غير متوفر للتلخيص';
            return;
        }

        $content = trim(strip_tags($blog->content));

        // مسار سكربت بايثون
        $scriptPath = base_path('app/Python/local_summarize.py');

        $pythonPath = PHP_OS_FAMILY === 'Windows'
            ? '"C:\\Program Files\\Python312\\python.exe"'
            : '/usr/bin/python3';

        $process = proc_open(
            "$pythonPath $scriptPath",
            [
                0 => ['pipe','r'],
                1 => ['pipe','w'],
                2 => ['pipe','w'],
            ],
            $pipes
        );

        if (!is_resource($process)) {
            $this->summary = 'فشل تشغيل سكربت بايثون';
            return;
        }

        // إرسال النص إلى بايثون
        fwrite($pipes[0], $content);
        fclose($pipes[0]);

        $output = trim(stream_get_contents($pipes[1]));
        $error  = trim(stream_get_contents($pipes[2]));

        fclose($pipes[1]);
        fclose($pipes[2]);
        proc_close($process);

        $this->summary = $output ?: "لم يتم توليد الملخص ❌ $error";
    }

    public function render()
    {
        return view('livewire.article-summary');
    }
}