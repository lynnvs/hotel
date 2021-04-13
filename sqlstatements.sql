CREATE DATABASE hotel;

USE hotel;


CREATE TABLE kamer (
    idkamer INT NOT NULL AUTO_INCREMENT,
    kamernummer INT NULL,
    PRIMARY KEY (idkamer)
);

CREATE TABLE persoon (
    idpersoon INT NOT NULL AUTO_INCREMENT,
    naam VARCHAR(255) NULL,
    adres VARCHAR(255) NULL,
    plaats VARCHAR(255) NULL,
    postcode VARCHAR(255) NULL,
    telefoon VARCHAR(255) NULL,
    PRIMARY KEY (idpersoon)
);


-- Key CONSTRAINT werkt niet met verwijderen omdat het gelinkt is en je kan het dan niet meer verwijderen 
CREATE TABLE reservering (
    reserveringsnummer INT NOT NULL AUTO_INCREMENT,
    van DATE NULL,
    tot DATE NULL,
    persoon_idpersoon INT NOT NULL,
    kamer_idkamer INT NOT NULL,
    PRIMARY KEY(reserveringsnummer),
    /*CONSTRAINT FK_persoon*/ FOREIGN KEY (persoon_idpersoon) REFERENCES persoon(idpersoon),
    /*CONSTRAINT FK_kamer*/ FOREIGN KEY (kamer_idkamer) REFERENCES kamer(idkamer)
);

CREATE TABLE medewerkers (
    medewerkerscode INT NOT NULL AUTO_INCREMENT,
    voorletters VARCHAR(255) NOT NULL,
    voorvoegsel VARCHAR(255),
    achternaam VARCHAR(255) NOT NULL,
    gebruikersnaam VARCHAR(255) NOT NULL,
    wachtwoord VARCHAR(255) NOT NULL,
    PRIMARY KEY(medewerkerscode)
);