<?php

namespace API\V1\Rest\I18n;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use API\V1\Entity\I18n;
use API\V1\Entity\Language;

/**
 * Recursos de traduções e idiomas
 */
class I18nResource extends AbstractResourceListener {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    /**
     * Cria um novo idioma
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data) {
        $permitidos = ['admin'];
        if (!$this->isAutorized($permitidos)) {
            return new ApiProblem(401, 'Permission denied!');
        }

        $language = new Language();
        $language->setLang($data->lang)
                ->setName($data->idioma);

        $this->em->persist($language);

        $dicionario = $this->em->createQueryBuilder()
                ->select(['i'])
                ->from(I18n::class, 'i')
                ->where('i.lang = :lang')
                ->setParameter('lang', 'pt-BR')
                ->getQuery()
                ->getResult();

        $i = 0;
        foreach ($dicionario as $value) {
            $i18n = new I18n();
            $i18n->setLang($data->lang)
                    ->setTitle($value->getTitle())
                    ->setValue('');
            $this->em->persist($i18n);

            if ($i > 15) {
                $this->em->flush();
            }
        }
        $this->em->flush();
        
        return [
            'language' => $language->getData()
        ];
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id) {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data) {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * recupera dicionário de um idioma
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id) {
        $dicionario = $this->em->createQueryBuilder()
                ->select(['i'])
                ->from(I18n::class, 'i')
                ->where('i.lang = :lang')
                ->setParameter('lang', $id)
                ->orderBy('i.id', 'DESC')
                ->getQuery()
                ->getResult();

        $retorno = [];

        foreach ($dicionario as $palavra) {
            $retorno[$palavra->getTitle()] = $palavra->getValue();
        }

        return $retorno;
    }

    /**
     * recupera lista de idiomas
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = []) {
        return [
            'languages' => $this->em->createQueryBuilder()
                    ->select(['l'])
                    ->from(Language::class, 'l')
                    ->orderBy('l.lang', 'ASC')
                    ->getQuery()
                    ->getArrayResult()
        ];
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data) {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patchList($data) {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data) {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data) {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }

}
