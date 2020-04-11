<?php

namespace API\V1\Rest\Image;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use API\V1\Entity\Image;

class ImageResource extends AbstractResourceListener {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    /**
     * Diretório para armazenamento de imagens
     * @var string 
     */
    private $dir = __DIR__ . '/../../../../../../data/imagens/';

    /**
     * Persiste um imagem
     * @param string|blob $imagem
     * @param Image $foto
     * @return Image
     * @throws \Exception
     */
    public function saveInternal($imagem, $foto = null) {
        if ($foto === null) {
            $foto = new Image();
        }

        if (\preg_match('/^data:image\/(\w+);base64,/', $imagem)) {
            $mime = explode(';', $imagem);
            $mime = str_replace('data:', '', $mime[0]);
            $foto->setMime($mime);

            $imagem = substr($imagem, strpos($imagem, ',') + 1);
            $imagem = base64_decode($imagem);
            if ($imagem === false) {
                throw new \Exception('base64_decode Error!');
            }
        } else {
            $mime = explode(';', $imagem);
            $mime = str_replace('data:', '', $mime[0]);
            $foto->setMime($mime);

            $imagem = substr($imagem, strpos($imagem, ',') + 1);
            $imagem = base64_decode($imagem);
            if ($imagem === false) {
                throw new \Exception('base64_decode Error!');
            }
        }

        $this->em->persist($foto);
        $this->em->flush();

        $nome = $this->dir . $foto->getId();
        \file_put_contents($nome, $imagem);
        return $foto;
    }

    /**
     * Persiste um QRCode
     * @param string|blob $imagem
     * @param Image $foto
     * @return stdClass
     * @throws \Exception
     */
    public function saveQRCode() {
        $foto = new Image();
        $foto->setMime('image/png');

        $this->em->persist($foto);
        $this->em->flush();

        $nome = $this->dir . $foto->getId();
        return (object) [
                    'QRCode' => $foto,
                    'dir' => $nome
        ];
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data) {
        $foto = new Image();

        if (\preg_match('/^data:image\/(\w+);base64,/', $data->imagem)) {
            $mime = explode(';', $data->imagem);
            $mime = str_replace('data:', '', $mime[0]);
            $foto->setMime($mime);

            $imagem = substr($imagem, strpos($imagem, ',') + 1);
            $imagem = base64_decode($imagem);
            if ($imagem === false) {
                throw new \Exception('base64_decode Error!');
            }
        } else {
            throw new \Exception('Invalid image!');
        }

        $this->em->persist($foto);
        $this->em->flush();

        $nome = $this->dir . $foto->getId() . '.png';
        \file_put_contents($nome, $imagem);
        return [
            'status' => 'ok',
            'mensagem' => 'Imagem criada',
            'url' => '/image/' . $foto->getId()
        ];
    }

    /**
     * Recupera uma imagem por API
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id) {
        $foto = $this->em->find(Image::class, $id);
        if ($foto) {
            $imagem = \file_get_contents($this->dir . $foto->getId());
            header('Content-type:' . $foto->getMime());
            echo $imagem;
            exit();
        }

        // Imagem não encontrada
        $imagem = \file_get_contents($this->dir . '/../not-found.png');
        header('Content-type:image/png');
        echo $imagem;
        exit();
    }

}
