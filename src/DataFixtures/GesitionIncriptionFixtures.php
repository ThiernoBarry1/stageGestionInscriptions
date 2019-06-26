<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Session;
use App\Entity\FondsAide;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class GesitionIncriptionFixtures extends Fixture
{   
/**
 * permet de créer les entity en dur pour commencer.
 *
 * @param ObjectManager $manager
 * @return void
 */
    public function load(ObjectManager $manager)
    {   

        $fondsAideErlc = new FondsAide();
        $session1 = new Session();
        $session1->setNom('session 1')
                 ->setDateDebut(new DateTime('2018-09-27'))
                 ->setDateFin(new DateTime('2018-10-11'))
                 ->setPreselection(new DateTime('2018-11-13'))
                 ->setPleniere(new DateTime('2018-12-18'))
                 ->setFondsAide($fondsAideErlc);
        $session2 = new Session();
        $session2->setNom('session 2')
                 ->setDateDebut(new DateTime('2019-01-04'))
                 ->setDateFin(new DateTime('2019-01-18'))
                 ->setPreselection(new DateTime('2019-02-18'))
                 ->setPleniere(new DateTime('2019-03-19'))
                 ->setFondsAide($fondsAideErlc);
        $session3 = new Session();
        $session3->setNom('session 3')
                 ->setDateDebut(new DateTime('2019-04-19'))
                 ->setDateFin(new DateTime('2019-05-03'))
                 ->setPreselection(new DateTime('2019-06-11'))
                 ->setPleniere(new DateTime('2019-07-11'))
                 ->setFondsAide($fondsAideErlc);
        $manager->persist($session1);
        $manager->persist($session2);
        $manager->persist($session3);
        $fondsAideErlc->setNom("Écriture et réecriture long métrage cinéma")
                             ->addSession($session1)
                             ->addSession($session2)
                             ->addSession($session3);
        $manager->persist($fondsAideErlc);
        $fondsAideEdd = new FondsAide();
        $session1 = new Session();
        $session1->setNom('session 1')
                 ->setDateDebut(new DateTime('2019-01-11'))
                 ->setDateFin(new DateTime('2019-01-25'))
                 ->setPreselection(new DateTime('2019-02-21'))
                 ->setPleniere(new DateTime('2019-03-12'))
                 ->setFondsAide($fondsAideEdd);
        $session2 = new Session();
        $session2->setNom('session 2')
                 ->setDateDebut(new DateTime('2019-05-06'))
                 ->setDateFin(new DateTime('2019-05-20 '))
                 ->setPreselection(new DateTime('2019-06-20'))
                 ->setPleniere(new DateTime('2019-07-10'))
                 ->setFondsAide($fondsAideEdd);
        $manager->persist($session1);
        $manager->persist($session2);
        $fondsAideEdd->setNom("Écriture et développement documentaire")
                     ->addSession($session1)
                     ->addSession($session2);
        $manager->persist($fondsAideEdd);
      
        $fondsAideCreation = new FondsAide();
        $session1 = new Session();
        $session1->setNom('session 1')
                 ->setDateDebut(new DateTime('2018-11-22'))
                 ->setDateFin(new DateTime('2018-12-06'))
                 ->setPreselection(new DateTime('2019-01-10'))
                 ->setPleniere(new DateTime('2019-01-24'))
                 ->setFondsAide($fondsAideCreation);
        $session2 = new Session();
        $session2->setNom('session 2')
                 ->setDateDebut(new DateTime('2019-04-25'))
                 ->setDateFin(new DateTime('2019-05-09'))
                 ->setPreselection(new DateTime('2019-06-17'))
                 ->setPleniere(new DateTime('2019-07-09 '))
                 ->setFondsAide($fondsAideCreation);
        $manager->persist($session1);
        $manager->persist($session2);
        $fondsAideCreation->setNom("Création Images differentes et nouveaux médias")
                         ->addSession($session1)
                         ->addSession($session2);
        $manager->persist($fondsAideCreation);

        $productionCmfa = new FondsAide();
        $session1 = new Session();
        $session1->setNom('session 1')
                 ->setDateDebut(new DateTime('2018-09-27'))
                 ->setDateFin(new DateTime('2018-10-11'))
                 ->setPleniere(new DateTime('2018-12-18'))
                 ->setNumerusClausus(40)
                 ->setFondsAide($productionCmfa);
        $session2 = new Session();
        $session2->setNom('session 2')
                 ->setDateDebut(new DateTime('2019-01-04'))
                 ->setDateFin(new DateTime('2019-01-18'))
                 ->setPleniere(new DateTime('2019-03-19'))
                 ->setNumerusClausus(40)
                 ->setFondsAide($productionCmfa);
        $session3 = new Session();
        $session3->setNom('session 3')
                 ->setDateDebut(new DateTime('2019-04-19'))
                 ->setDateFin(new DateTime('2019-05-03'))
                 ->setPleniere(new DateTime('2019-07-11'))
                 ->setNumerusClausus(40)
                 ->setFondsAide($productionCmfa);
        $manager->persist($session1);
        $manager->persist($session2);
        $manager->persist($session3);
        $productionCmfa->setNom("Production court métrage fiction et animation")
                       ->addSession($session1)
                       ->addSession($session2)
                      ->addSession($session3);
        $manager->persist($productionCmfa);
      
        

        $productionlongMc = new FondsAide();
        $session1 = new Session();
        $session1->setNom('session 1')
                 ->setDateDebut(new DateTime('2018-09-27'))
                 ->setDateFin(new DateTime('2018-10-16'))
                 ->setPleniere(new DateTime('2018-12-18'))
                 ->setFondsAide($productionlongMc);
        $session2 = new Session();
        $session2->setNom('session 2')
                 ->setDateDebut(new DateTime('2019-01-04'))
                 ->setDateFin(new DateTime('2019-01-18'))
                 ->setPleniere(new DateTime('2019-03-19'))
                 ->setFondsAide($productionlongMc);
        $session3 = new Session();
        $session3->setNom('session 3')
                 ->setDateDebut(new DateTime('2019-04-19'))
                 ->setDateFin(new DateTime('2019-05-03'))
                 ->setPleniere(new DateTime('2019-07-11'))
                 ->setFondsAide($productionlongMc);
        $manager->persist($session1);
        $manager->persist($session2);
        $manager->persist($session3);
        $productionlongMc->setNom("Production long métrage cinéma")
                       ->addSession($session1)
                       ->addSession($session2)
                      ->addSession($session3);
        $manager->persist($productionlongMc);
   
        $productionCdAudio = new FondsAide();
        $session1 = new Session();
        $session1->setNom('session 1')
                 ->setDateDebut(new DateTime('2018-09-27'))
                 ->setDateFin(new DateTime('2018-10-16'))
                 ->setPleniere(new DateTime('2018-12-18'))
                 ->setFondsAide($productionCdAudio);
        $session2 = new Session();
        $session2->setNom('session 2')
                 ->setDateDebut(new DateTime('2019-01-04'))
                 ->setDateFin(new DateTime('2019-01-18'))
                 ->setPleniere(new DateTime('2019-03-19'))
                 ->setFondsAide($productionCdAudio);
        $session3 = new Session();
        $session3->setNom('session 3')
                 ->setDateDebut(new DateTime('2019-04-19'))
                 ->setDateFin(new DateTime('2019-05-03'))
                 ->setPleniere(new DateTime('2019-07-11'))
                 ->setFondsAide($productionCdAudio);
        $manager->persist($session1);
        $manager->persist($session2);
        $manager->persist($session3);
        $productionCdAudio->setNom("Production documentaire audiovisuel")
                       ->addSession($session1)
                       ->addSession($session2)
                      ->addSession($session3);
        $manager->persist($productionCdAudio);
        $productionFicAudio = new FondsAide();
        $session1 = new Session();
        $session1->setNom('session 1')
                 ->setDateDebut(new DateTime('2018-09-27'))
                 ->setDateFin(new DateTime('2018-10-16'))
                 ->setPleniere(new DateTime('2018-12-18'))
                 ->setFondsAide($productionFicAudio);
        $session2 = new Session();
        $session2->setNom('session 2')
                 ->setDateDebut(new DateTime('2019-01-04'))
                 ->setDateFin(new DateTime('2019-01-18'))
                 ->setPleniere(new DateTime('2019-03-19'))
                 ->setFondsAide($productionFicAudio);
        $manager->persist($session1);
        $manager->persist($session2);
        $productionFicAudio->setNom("Production fiction audiovisuelle")
                       ->addSession($session1)
                       ->addSession($session2);
        $manager->persist($productionFicAudio);
      
        $productionCmd = new FondsAide();
        $session1 = new Session();
        $session1->setNom('session 1')
                 ->setDateDebut(new DateTime('2018-09-27'))
                 ->setDateFin(new DateTime('2018-10-16'))
                 ->setPleniere(new DateTime('2018-12-18'))
                 ->setFondsAide($productionCmd);
        $session2 = new Session();
        $session2->setNom('session 2')
                 ->setDateDebut(new DateTime('2019-01-04'))
                 ->setDateFin(new DateTime('2019-01-18'))
                 ->setPleniere(new DateTime('2019-03-19'))
                 ->setFondsAide($productionCmd);
        $session3 = new Session();
        $session3->setNom('session 3')
                 ->setDateDebut(new DateTime('2019-04-19'))
                 ->setDateFin(new DateTime('2019-05-03'))
                 ->setPleniere(new DateTime('2019-07-11'))
                 ->setFondsAide($productionCmd);
        $manager->persist($session1);
        $manager->persist($session2);
        $manager->persist($session3);
        $productionCmd->setNom("Production court métrage documentaire")
                       ->addSession($session1)
                       ->addSession($session2)
                      ->addSession($session3);
        $manager->persist($productionCmd);

        $programmeDeveloppementSp = new FondsAide();
        $session1 = new Session();
        $session1->setNom('session 1')
                 ->setDateDebut(new DateTime('2018-09-27'))
                 ->setDateFin(new DateTime('2018-10-16'))
                 ->setPleniere(new DateTime('2018-12-18'))
                 ->setFondsAide($programmeDeveloppementSp);
        $manager->persist($session1);
        $programmeDeveloppementSp->setNom("Programme de développement des structures de production")
                                 ->addSession($session1);
        $manager->persist($programmeDeveloppementSp);
        $manager->flush();
    }
}
