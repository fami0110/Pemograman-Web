CREATE TABLE IF NOT EXISTS buku (
  id SERIAL PRIMARY KEY,
  judul VARCHAR(255) NOT NULL,
  pengarang VARCHAR(255) NOT NULL,
  tahun INTEGER NOT NULL,
  isbn VARCHAR(50),
  stok INTEGER NOT NULL DEFAULT 0,
  kategori VARCHAR(50)
);

INSERT INTO buku 
  (judul, pengarang, tahun, isbn, stok, kategori)
VALUES 
  ('Laskar Pelangi', 'Andrea Hirata', 2005, '978-602-8533-55-5', 4, 'Drama'),
  ('Bumi Manusia', 'Pramoedya Ananta Toer', 1980, '978-602-8518-93-8', 2, 'Sejarah'),
  ('Negeri 5 Menara', 'Ahmad Fuadi', 2009, '978-602-8394-86-7', 0, 'Inspiratif'),
  ('Filosofi Teras', 'Henry Manampiring', 2018, '978-602-8605-50-3', 5, 'Self-Improvement'),
  ('Ronggeng Dukuh Paruk', 'Ahmad Tohari', 1982, '978-602-8263-84-8', 1, 'Sastra'),
  ('Cantik Itu Luka', 'Eka Kurniawan', 2002, '978-602-8795-95-0', 3, 'Sastra'),
  ('Pulang', 'Tere Liye', 2015, '978-602-8154-45-7', 2, 'Laga'),
  ('Sang Pemimpi', 'Andrea Hirata', 2006, '978-602-8555-60-8', 6, 'Drama'),
  ('Perahu Kertas', 'Dee Lestari', 2009, '978-602-8162-70-4', 0, 'Romantis'),
  ('Gadis Kretek', 'Ratih Kumala', 2012, '978-602-8579-50-8', 4, 'Sejarah');