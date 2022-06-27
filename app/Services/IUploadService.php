<?php

namespace App\Services;

interface IUploadService
{
    /**
     * Método para carregar um arquivo da requisição e salva-lo no servidor
     *
     * @param  \Illuminate\Http\Request; $request Objeto request utilizado para carregar o arquivo
     * @param  string $name Nome do campo da requisição
     * @param  string $directory Diretório onde será armazenado o arquivo
     * @return string Caminho do arquivo salvo no servidor
     */
    public function loadFromRequest($request, $name, $directory);

    /**
     * Método para carregar vários arquivos da requisição e salva-los no servidor
     *
     * @param  \Illuminate\Http\Request; $request Objeto request utilizado para carregar o arquivo
     * @param  string $name Nome do campo da requisição
     * @param  string $directory Diretório onde serão armazenados os arquivos
     * @return array Lista de caminhos dos arquivos salvos no servidor
     */
    public function loadFromRequestMultiple($request, $name, $directory);
}
