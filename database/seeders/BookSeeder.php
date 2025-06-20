<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'genre' => 'Fiction',
                'isbn' => '9780061120084',
                'description' => 'A gripping tale of racial injustice and childhood innocence.',
                'published_year' => 1960,
                'total_copies' => 5,
                'available_copies' => 5,
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'genre' => 'Dystopian Fiction',
                'isbn' => '9780451524935',
                'description' => 'A totalitarian future where Big Brother watches everything.',
                'published_year' => 1949,
                'total_copies' => 3,
                'available_copies' => 2,
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'genre' => 'Romance',
                'isbn' => '9780141439518',
                'description' => 'A witty romance about Elizabeth Bennet and Mr. Darcy.',
                'published_year' => 1813,
                'total_copies' => 4,
                'available_copies' => 4,
            ],
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'genre' => 'Fiction',
                'isbn' => '9780743273565',
                'description' => 'The story of Jay Gatsby and his obsession with Daisy Buchanan.',
                'published_year' => 1925,
                'total_copies' => 6,
                'available_copies' => 5,
            ],
            [
                'title' => 'Harry Potter and the Philosopher\'s Stone',
                'author' => 'J.K. Rowling',
                'genre' => 'Fantasy',
                'isbn' => '9780747532699',
                'description' => 'The beginning of Harry Potter\'s magical journey.',
                'published_year' => 1997,
                'total_copies' => 8,
                'available_copies' => 6,
            ],
            [
                'title' => 'The Catcher in the Rye',
                'author' => 'J.D. Salinger',
                'genre' => 'Fiction',
                'isbn' => '9780316769174',
                'description' => 'The story of Holden Caulfield and his disillusionment.',
                'published_year' => 1951,
                'total_copies' => 3,
                'available_copies' => 3,
            ],
            [
                'title' => 'Lord of the Flies',
                'author' => 'William Golding',
                'genre' => 'Fiction',
                'isbn' => '9780571056866',
                'description' => 'A group of boys stranded on an island and their descent into savagery.',
                'published_year' => 1954,
                'total_copies' => 4,
                'available_copies' => 4,
            ],
            [
                'title' => 'The Lord of the Rings',
                'author' => 'J.R.R. Tolkien',
                'genre' => 'Fantasy',
                'isbn' => '9780544003415',
                'description' => 'An epic fantasy adventure in Middle-earth.',
                'published_year' => 1954,
                'total_copies' => 5,
                'available_copies' => 4,
            ],
            [
                'title' => 'Brave New World',
                'author' => 'Aldous Huxley',
                'genre' => 'Science Fiction',
                'isbn' => '9780060850524',
                'description' => 'A dystopian society where everyone is conditioned to be happy.',
                'published_year' => 1932,
                'total_copies' => 3,
                'available_copies' => 3,
            ],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'genre' => 'Fantasy',
                'isbn' => '9780547928227',
                'description' => 'Bilbo Baggins\' unexpected journey.',
                'published_year' => 1937,
                'total_copies' => 6,
                'available_copies' => 5,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
