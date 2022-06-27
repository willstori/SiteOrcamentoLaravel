<?php

namespace App\Services;

interface IImageService
{
    /**
     * Método para redimensionar a imagem para cobrir todo retângulo
     *
     * @param  string $file Arquivo com caminho completo
     * @param  int $width Largura em pixels
     * @param  int $height Altura em pixels
     * @return void
     */
    public function resizeFit($file, $width, $height);

    /**
     * Método para redimensionar a imagem para encaixar dentro do retângulo
     *
     * @param  string $file Arquivo com caminho completo
     * @param  int $width Largura em pixels
     * @param  int $height Altura em pixels
     * @return void
     */
    public function resize($file, $width = 800, $height = 600);
}
