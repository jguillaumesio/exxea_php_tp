CREATE TABLE books (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    ISBN VARCHAR(50) NOT NULL,
    theme VARCHAR(100) NOT NULL,
    page_nbr INT(5) NOT NULL,
    format VARCHAR(50) NOT NULL,
    author_firstname VARCHAR(100) NOT NULL,
    author_lastname VARCHAR(100) NOT NULL,
    editor VARCHAR(100) NOT NULL,
    edition_year INT(4) NOT NULL,
    price DECIMAL(5, 0) NOT NULL,
    language VARCHAR(50) NOT NULL
);

INSERT INTO books (title, ISBN, theme, page_nbr, format, author_firstname, author_lastname, editor, edition_year, price, language)
VALUES
    ('To Kill a Mockingbird', '9780061120084', 'Classic', 281, 'Paperback', 'Harper', 'Lee', 'HarperCollins', 1960, 9.99, 'English'),
    ('1984', '9780451524935', 'Dystopian', 328, 'Hardcover', 'George', 'Orwell', 'Signet', 1949, 12.99, 'English'),
    ('The Great Gatsby', '9780743273565', 'Fiction', 180, 'Paperback', 'F. Scott', 'Fitzgerald', 'Scribner', 1925, 8.99, 'English'),
    ('Pride and Prejudice', '9780679783268', 'Romance', 279, 'Paperback', 'Jane', 'Austen', 'Modern Library', 1813, 7.99, 'English'),
    ('The Catcher in the Rye', '9780316769174', 'Coming-of-age', 277, 'Hardcover', 'J.D.', 'Salinger', 'Little, Brown', 1951, 10.99, 'English'),
    ('The Hobbit', '9780345339683', 'Fantasy', 366, 'Paperback', 'J.R.R.', 'Tolkien', 'Del Rey', 1937, 11.99, 'English'),
    ('The Lord of the Rings', '9780544003415', 'Fantasy', 1178, 'Hardcover', 'J.R.R.', 'Tolkien', 'Mariner', 1954, 19.99, 'English'),
    ('The Da Vinci Code', '9780307474278', 'Mystery', 454, 'Paperback', 'Dan', 'Brown', 'Anchor', 2003, 13.99, 'English'),
    ('Harry Potter and the Sorcerer''s Stone', '9780590353427', 'Fantasy', 309, 'Paperback', 'J.K.', 'Rowling', 'Scholastic', 1997, 9.99, 'English'),
    ('Brave New World', '9780060850524', 'Dystopian', 288, 'Paperback', 'Aldous', 'Huxley', 'Harper Perennial', 1932, 9.99, 'English');

