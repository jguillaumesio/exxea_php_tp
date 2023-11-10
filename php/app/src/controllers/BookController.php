<?php

namespace App\controllers;

class BookController extends AbstractController
{

    public function index() {
        $query = "SELECT * FROM books";
        $result = $this->db->query($query);
        if ($result)
        {
            $books = $result->fetchAll(\PDO::FETCH_ASSOC);
        } else
        {
            $books = [];
        }
        $template = $this->twig->load('book/list.twig');
        echo $template->render(['books' => $books, 'page_title' => 'List of Books']);
    }

    public function show($id) {
        $query = "SELECT * FROM books WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if ($stmt)
        {
            $book = $stmt->fetch(\PDO::FETCH_ASSOC);
        } else
        {
            $book = [];
        }
        $template = $this->twig->load('book/detail.twig');
        echo $template->render(['book' => $book, 'page_title' => $book['title']]);

    }

    public function create() {
        $requiredFields = ['title', 'ISBN', 'theme', 'page_nbr', 'format', 'author_firstname', 'author_lastname', 'editor', 'edition_year', 'price', 'language'];
        $allFieldsSet = true;
        foreach ($requiredFields as $field) {
            if (!isset($_POST[$field])) {
                echo $field;
                $allFieldsSet = false;
                break;
            }
        }
        if ($allFieldsSet) {
            $sanitizedData = array_map('strip_tags', array_map('htmlspecialchars', $_POST));

            $query = "INSERT INTO books (title, ISBN, theme, page_nbr, format, author_firstname, author_lastname, editor, edition_year, price, language)
                  VALUES (:title, :ISBN, :theme, :page_nbr, :format, :author_firstname, :author_lastname, :editor, :edition_year, :price, :language)";
            $stmt = $this->db->prepare($query);

            foreach ($requiredFields as $field) {
                $stmt->bindParam(':' . $field, $sanitizedData[$field]);
            }
            try{
                $stmt->execute();
            } catch (\Exception $e) {
                $this->logError($e);
            }
        }
        // Redirect to the home page
        header("Location: /");
        exit();
    }

    public function update($id) {
        $requiredFields = ['title', 'ISBN', 'theme', 'page_nbr', 'format', 'author_firstname', 'author_lastname', 'editor', 'edition_year', 'price', 'language'];
        $allFieldsSet = true;

        foreach ($requiredFields as $field) {
            if (!isset($_POST[$field])) {
                $allFieldsSet = false;
                break;
            }
        }

        if ($allFieldsSet) {
            $sanitizedData = array_map('strip_tags', array_map('htmlspecialchars', $_POST));

            $query = "UPDATE books
                  SET title = :title, ISBN = :ISBN, theme = :theme, page_nbr = :page_nbr, format = :format,
                  author_firstname = :author_firstname, author_lastname = :author_lastname, editor = :editor,
                  edition_year = :edition_year, price = :price, language = :language
                  WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);

            foreach ($requiredFields as $field) {
                $stmt->bindParam(':' . $field, $sanitizedData[$field]);
            }

            try{
                $stmt->execute();
            } catch (\Exception $e) {
                $this->logError($e);
            }
            // Redirect to the home page
            header("Location: /");
            exit();
        }
    }

    public function delete($id) {
        $query = "DELETE FROM books WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        try{
            $stmt->execute();
        } catch (\Exception $e) {
            $this->logError($e);
        }

        // Redirect to the home page
        header("Location: /");
        exit();
    }
}
