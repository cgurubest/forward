<?php

namespace Cgurubest\BlogBundle\Controller;

use Cgurubest\BlogBundle\Entity\ControlForwardList;
use Cgurubest\BlogBundle\Entity\DocumentList;
use Cgurubest\BlogBundle\Entity\UserList;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Faker\Factory;
use Doctrine\Common\Collections\Criteria;

class ForwardController extends Controller
{
    public function indexAction(){

        $data['users'] = $this->getDoctrine()->getRepository(UserList::class)->findAll();
        $data['test'] = 'read';

        return $this->render("CgurubestBlogBundle::user_list.html.twig", $data);

    }

    public function docListAction($user_id){

        $data['user'] = $this->getDoctrine()->getRepository(UserList::class)->find($user_id);

        //Получаем список контролируемых документов для конкретного пользователя
        $docs_id = $this->getDoctrine()->getRepository(ControlForwardList::class)->findBy([
            'user_id' => $user_id,
            'is_active' => true,
        ]);

        foreach ($docs_id as $doc){
            $data['docs_control'][] = $this->getDoctrine()->getRepository(DocumentList::class)->find($doc->getDocId());
        }

        //Полчаем список всех типов документа
        $data['docs_type'] = $this->getDoctrine()->getRepository(DocumentList::class)->findAll();


        return $this->render("CgurubestBlogBundle::doc_list.html.twig",$data);
    }

    public function docAddAction($user_id, $doc_id){
        $document = $this->getDoctrine()->getRepository(DocumentList::class)->find($doc_id);
        $user = $this->getDoctrine()->getRepository(UserList::class)->find($user_id);

        $check_if_exists = $this->getDoctrine()->getRepository(ControlForwardList::class)->findOneBy([
            'user_id' => $user_id,
            'doc_id' => $doc_id,
            'is_active' => true
        ]);


        if ($document !== null && $user !== null && !$check_if_exists){

            $add_db = $this->getDoctrine()->getManager();
            $setForward = new ControlForwardList();

            $setForward->setUserId($user->getId());
            $setForward->setDocId($document->getId());
            $setForward->setIsActive(true);
            $add_db->persist($setForward);
            $add_db->flush();

        }

        return $this->redirect($this->generateUrl('forward_doc_list',['user_id' => $user_id]));

    }

    public function docDelAction($user_id, $doc_id){
        $db = $this->getDoctrine()->getManager();

        $record_in_db = $this->getDoctrine()->getRepository(ControlForwardList::class)->findOneBy([
            'user_id' => $user_id,
            'doc_id' => $doc_id,
            'is_active' => true
        ]);

        $db->remove($record_in_db);
        $db->flush();

        return $this->redirect($this->generateUrl('forward_doc_list',['user_id' => $user_id]));
    }

    public function DataAction(){
        $faker = Factory::create('ru_RU');

        $add_db = $this->getDoctrine()->getManager();

        for ($i=0;$i<10;$i++){
            $user = new UserList();
            $document = new DocumentList();

            $user->setName($faker->name);
            $document->setName($faker->city);

            $add_db->persist($document);
            $add_db->persist($user);
            $add_db->flush();
        }


        return $this->render("CgurubestBlogBundle::index.html.twig");
    }
}
