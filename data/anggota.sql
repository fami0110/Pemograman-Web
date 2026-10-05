CREATE TABLE IF NOT EXISTS anggota (
	id SERIAL PRIMARY KEY,
	nama VARCHAR(255) NOT NULL,
	no_anggota VARCHAR(50) NOT NULL UNIQUE,
	email VARCHAR(50),
	alamat VARCHAR(255),
	no_hp VARCHAR(30),
	tgl_bergabung TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO anggota 
	(nama, no_anggota, email, alamat, no_hp, tgl_bergabung)
VALUES 
	('Siti Aminah', 'A001', 'julava@em.ki', 'Malang', '0891816672293', '6/13/2035'),
	('Budi Santoso', 'A002', 'vez@digwawgij.id', 'Batu', '0899093748903', '2/20/2075'),
	('Dewi Lestari', 'A003', 'wenwufog@fatu.sb', 'Malang', '0899545584938', '6/28/2028'),
	('Rizky Firmansyah', 'A004', 'nucduvo@segra.br', 'Lawang', '0892041747702', '6/27/2039');