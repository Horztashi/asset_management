<?php

namespace AppBundle\Listener;


use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManagerInterface;
use Acme\Entity;

class AssetListener {

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate(PreUpdateEventArgs $event) {
/*		$entity = $event->getEntity();
        $em = $event->getEntityManager();
		if($event->hasChangedField('users'))
		{
			var_dump("Changed");
		}
        var_dump($event->getOldValue('description'));
        var_dump($em->getRepository('AppBundle:Asset')->findOneById($entity->getId())->getUsers()->count());
        exit();

        $log = new Entity\Log(...);

		


        $em->persist($log);
        $em->flush();
*/    }
}