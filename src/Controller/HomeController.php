<?php

namespace App\Controller;

use App\Entity\Home;
use App\Form\HomeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class HomeController extends AbstractController
{
    private $slugger;
    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    #[Route('/', name: 'app_home')]
    public function index(Request $request): Response
    {
        $home= new Home();
        $home_form = $this->createForm(HomeType::class, $home);
        $home_form->handleRequest($request);
        if ($home_form->isSubmitted() && $home_form->isValid()) {
            $excelFile = $home_form->get('fichier')->getData();
            if($excelFile){
                $this->upload($excelFile);
                shell_exec('cd /home/bamba/TagUI_Linux/tagui/flows/samples/ ');

                //  $filename = pathinfo($excelFile->getClientOriginalName(), PATHINFO_FILENAME);
              //  $process = new Process(['']);
               // $process->run();
                // executes after the command finishes
              //  if (!$process->isSuccessful()) {
                //    throw new ProcessFailedException($process);
               // }
               // echo $process->getOutput();
            }
        }
        return $this->render('home/index.html.twig', [
            'registrationForm'=>$home_form->createView()
        ]);
    }

    /*SERVICE*/
    public function upload(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
        $fileNameWithouId = $safeFilename.'.'.$file->guessExtension();
       // dd($safeFilename.'.'.$file->guessExtension());
        return $fileNameWithouId;
       // return $fileName;
    }
}
