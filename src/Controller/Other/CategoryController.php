<?php

declare(strict_types=1);

namespace App\Controller\Other;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use SYmfony\Component\HttpFoundation\Response;
use App\Repository\CategoryRepository;

class CategoryController extends AbstractController
{
    #[Route(path: '/categories/{id}', name: 'page_categories')]
    public function categories(
        string $id,
        CategoryRepository $categoryRepository,
    ): Response
    {
        $category = $categoryRepository->find($id);

        return $this->render('other/category.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route(path: '/discover', name: 'page_discover')]
    public function discover(
        CategoryRepository $categoryRepository,
    ): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('other/discover.html.twig', [
            'categories' => $categories,
        ]);
    }
}
