<?php

function formatarSaidaDiretorio($listaArquivos) {
    $resultado = [];

    foreach ($listaArquivos as $arquivo) {
        if (is_file($arquivo)) {
            $tamanho = filesize($arquivo) . ' bytes';
            $resultado[] = [
                'nome' => $arquivo,
                'tamanho' => $tamanho,
                'tipo' => obterTipoArquivo($arquivo),
            ];
        } else {
            $resultado[] = [
                'nome' => $arquivo,
                'tamanho' => '-',
                'tipo' => [
                    'mime' => 'directory',
                    'icon' => '<i class="bi bi-folder"></i>'
                ],
            ];
        }
    }

    return $resultado;
    
}

function obterTipoArquivo($nomeArquivo) {
    
    $tiposConhecidos = [
        ".jpg" => [
            'mime' => 'image/jpeg',
            'icon' => '<i class="bi bi-file-earmark-image"></i>'
        ],
        ".jpeg" => [
            'mime' => 'image/jpeg',
            'icon' => '<i class="bi bi-file-earmark-image"></i>'
        ],
        ".png" => [
            'mime' => 'image/png',
            'icon' => '<i class="bi bi-file-earmark-image"></i>'
        ],
        ".pdf" => [
            'mime' => 'document/pdf',
            'icon' => '<i class="bi bi-filetype-pdf"></i>'
        ],
        ".doc" => [
            'mime' => 'document/doc',
            'icon' => '<i class="bi bi-file-earmark"></i>'
        ],
        ".docx" => [
            'mime' => 'document/doc',
            'icon' => '<i class="bi bi-file-earmark"></i>'
        ],
        ".txt" => [
            'mime' => 'document/txt',
            'icon' => '<i class="bi bi-file-earmark"></i>'
        ],
    ];

    $extensao = strrchr($nomeArquivo, '.');

    if (key_exists($extensao, $tiposConhecidos)) {
        return $tiposConhecidos[$extensao];
    } 

    return [
            'mime' => 'unknow',
            'icon' => '<i class="bi bi-file-binary-fill"></i>'
        ];
}


function retornaImagem($arquivosAtuais) {
    $directory = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"> <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" /> </svg>';

    $file = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"> <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /> </svg>';

    $otherDocuments = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"> <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" /> </svg>';

    if (is_dir($arquivosAtuais)) {
        return $directory;
    }
    else if (is_file($arquivosAtuais)) {
        return $file;
    } 
    else {
        return $otherDocuments;
    }

}