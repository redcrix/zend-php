<?php

namespace API\V1\Rpc\SaveMyAccount;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Rest\Image\ImageResource;
use API\V1\Entity\Address;
use API\V1\Entity\User;
/**
 * RPC para salvar dados do usuário logado
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class SaveMyAccountController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function saveMyAccountAction() {
        $permitidos = ['admin', 'owner', 'employee', 'manager'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }
        
        $data = (object) $this->bodyParams();

        $user = $this->user;
        $user = $this->persistAddress($user, $data);
        $user = $this->persistPhoto($user, $data);

        $user->setDocument($data->documento)
                ->setName($data->nome)
                ->setPhone($data->phone);

        $this->em->persist($user);
        $this->em->flush();

        return [
            'status' => 'ok'
        ];
    }
    
    /**
     * Checa se existe informações de endereço
     * @param stdClass $data
     * @return boolean
     */
    protected function checkAddress($data) {
        $keys = [
            'endereco', 'numero', 'bairro', 'cidade',
            'estado', 'pais', 'complemento', 'cep'
        ];
        foreach ($data as $key => $v) {
            if (in_array($key, $keys)) {
                if (isset($v)) {
                    return true;
                }
            }
        }
        return false;
    }
    
    /**
     * Persiste um endereço a um usuário
     * @param User $user
     * @param stdClass $data
     * @return User
     */
    public function persistAddress(User $user, $data) {
        $address = $user->getAddress();
        if (!$address && $this->checkAddress($data)) {
            $address = new Address();
        }

        if (!!$address) {
            $address->setAddress($data->endereco)
                    ->setNumber($data->numero)
                    ->setAddress2($data->bairro)
                    ->setAddress3($data->complemento)
                    ->setCity($data->cidade)
                    ->setState($data->estado)
                    ->setZipcode($data->cep)
                    ->setCountry($data->pais);
            $this->em->persist($address);
        }

        $user->setAddress($address);
        return $user;
    }
    
    /**
     * Persiste uma imagem a um usuário
     * @param User $user
     * @param type $data
     * @return User
     */
    protected function persistPhoto(User $user, $data) {
        if (isset($data->foto['id'])) {
            if ($data->foto['id'] == 0) {
                $imagemResource = new ImageResource($this->em);
                $foto = $imagemResource->saveInternal(
                        $data->foto['logo'], $user->getPhoto()
                );
                $user->setPhoto($foto);
            }
        }
        return $user;
    }

}
