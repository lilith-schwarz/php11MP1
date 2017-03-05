-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 05. Mrz 2017 um 16:38
-- Server-Version: 10.1.19-MariaDB
-- PHP-Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `locamole`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `produkte`
--

CREATE TABLE `produkte` (
  `id` int(3) NOT NULL,
  `name` varchar(100) COLLATE utf8_german2_ci NOT NULL,
  `menge` varchar(10) COLLATE utf8_german2_ci NOT NULL,
  `preis` float NOT NULL,
  `bild` varchar(100) COLLATE utf8_german2_ci NOT NULL,
  `beschreibung` varchar(300) COLLATE utf8_german2_ci NOT NULL,
  `zutaten` varchar(200) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `produkte`
--

INSERT INTO `produkte` (`id`, `name`, `menge`, `preis`, `bild`, `beschreibung`, `zutaten`) VALUES
(2, 'Gaucamole', '250g', 4.99, 'images/guacamole.jpg', 'Der Klassiker unter den Molen und das nicht ohne Grund, denn sie ist ebenso lecker wie simpel. Aus frischen Avocados hergestellt und mit Liebe abgeschmeckt, ein Genuss nicht nur als Beilage.', 'Avocados, Tomaten, Zitronensaft, Knoblauch, Salz und Pfeffer'),
(23, 'Mojo Rojo', '200g', 2.99, 'images/mojorojo.jpg', 'Feurig rot erinnert es an sein Herkunftsland. Aber auch der Geschmack kann sich sehen lassen, verleiht es doch den gewissen Kick zu jedem Gericht.', 'Knoblauch, Salz, KÃ¼mmel, Paprikapulver, OlivenÃ¶l, Essig'),
(24, 'Mojo Verde', '200g', 2.99, 'images/mojoverde.jpg', 'GrÃ¼n wird nicht ohne Grund mit gesund assoziiert â€“ Mojo Verde hÃ¤lt was die Farbe verspricht. Eine KrÃ¤uter Geschmacksexplosion.', 'Knoblauch, Koriander, OlivenÃ¶l, Petersilie, Pfeffer, Salz, Zitronensaft'),
(25, 'Hummus', '300g', 3.99, 'images/hummus.jpg', 'Voller und aromatischer Geschmack, der durch die verarbeiteten Kichererbsen eine angenehme Textur auf der Zunge bietet.', 'Kichererbsen, Knoblauch, OlivenÃ¶l, Tahin, KÃ¼mmel, Salz, Paprikapulver'),
(26, 'Mole Poblano', '200g', 2.99, 'images/molepoblano.jpg', 'Wer HeiÃŸhunger auf etwas un- aber auÃŸergewÃ¶hnliches hat, der ist mit unserer Mole Poblano wohl bestens bedient. Mit der besonderen Mischung aus Schokolade und Chili weiÃŸ sie zu Ã¼berzeugen.', 'Chilischoten, Zwiebeln, Knoblauch, Mandeln, ErdnÃ¼sse, Nelken, Pfeffer, Zimt, Anis, Rosinen, Zartbitterschokolade, Ã–l, Sesam, Tomaten'),
(27, 'Mole Amarillo', '200g', 3.99, 'images/moleamarillo.jpg', 'Auch Gelbe Mole genannt, bietet die Mole Amarillo eine neue farbliche und geschmackliche Nuance. Besonders wird sie durch ihre nussige aber auch orientalische Note.', 'Chilischoten, Nelken, KÃ¼mmel, Oregano, Safran, Knoblauch, Zwiebel, Tomatillos, Masa Harina'),
(28, 'Pipian Verde', '200g', 2.99, 'images/pipianverde.jpg', 'Leicht und dennoch mit vollen Geschmack, der durch die KÃ¼rbiskerne hervorgerufen wird, kann man die Pipian Verde nicht nur pur genieÃŸen, sie schmeckt auch besonders gut zu Reisgerichten.', 'KÃ¼rbiskerne, Butter, Zucker, Koriander, Chilischoten, Knoblauch, Zwiebeln, Tomatillos'),
(29, 'Mole Verde', '200g', 1.99, 'images/moleverde.jpg', 'Wer es weniger scharf mag und den runden und herben Geschmack von Spinat liebt, der sollte bei der Mole Verde zugreifen.', 'Tomatillos, Chilischoten, Zwiebel, Blattspinat, Knoblauch'),
(30, 'Mole Adobo', '200g', 2.99, 'images/moleadobo.jpg', 'Nach traditionellem, mexikanischen Rezept hergestellt. Mole Adobo ist besonders geeignet fÃ¼r diejenigen, die einen etwas herzhafteren Geschmack bevorzugen.', 'Tomatenpaste, Guajillo Chili, Zwiebel, Fett, Salz, Essig'),
(31, 'Avocado Mango Salsa', '200g', 4.99, 'images/avocadomangosalsa.jpg', 'FÃ¼r die, die etwas frisches bevorzugen, kann auch mal eine leckere Salsa auf dem Teller landen.', 'Avocado, Mango, Zwiebel, Tomaten, Chilischoten, Knoblauch, Ã–l, Zitronensaft'),
(32, 'Mole Negro', '200g', 3.99, 'images/molenegro.jpg', 'Mag man es etwas herber, so kann man sich auch mal an der Mole Negro probieren. Sie ist ebenfalls herzhaft und fÃ¼r manchen vielleicht ein bisschen ungewohnt, aber nicht weniger lecker.', 'Chilischoten, Sesam, Zwiebel, Kidneybohnen, Knoblauch, ErdnÃ¼sse, Sultaninen, Schokolade, Zimt'),
(33, 'Salsa classic', '200g', 1.99, 'images/salsaclassic.jpg', 'Der Klassiker, wie man ihn gerne zu Tortillas genieÃŸt. Bei diesem Dip kann man eigentlich nichts falsch machen und sollte zugreifen.', 'Tomaten, Schalotten, Limetten, Chilischote, Koriander, Salz'),
(34, 'Salsa Caliente', '200g', 2.99, 'images/salsacaliente.jpg', 'Ã„hnlich lecker wie die klassische Salsa, aber durch die CrÃ©me FraÃ®che bekommt es den gewissen Touch und sollte definitiv probiert werden.', 'Tomaten, Zwiebeln, Chilischoten, CrÃ©me FraÃ®che, Ã–l, Limettensaft, Salz'),
(35, 'Mole Coloradito', '200g', 2.99, 'images/molecoloradito.jpg', 'Eine Mischung aus Mole Rojo und Negro ist die Mole Coloradito. Die unterschiedlichen Zutaten ergÃ¤nzen sich in dieser Mole ideal.', 'Zwiebeln, Knoblauch, Schokolade, Tomaten, Chilischoten, Ã–l'),
(36, 'Mole Chichilo', '200g', 2.99, 'images/molechichilo.jpg', 'Fans eines intensiveren Geschmackes sollten zur Mole Chichilo greifen. Sie ist herb, herzhaft und lecker!', 'RinderbrÃ¼he, Chilischoten, Guajillos, Knoblauch, Zwiebeln, Masa Harina'),
(37, 'Mole Manchamantel', '150g', 3.99, 'images/molemanchamantel.jpg', 'Die Farbe ist intensiv, ebenso wie der Geschmack. Wer den vollen Geschmack Mexikos probieren mÃ¶chte, sollte hier zugreifen.', 'Tomaten, Fett, Ancho Chilischoten, Ananas, Zwiebel'),
(38, 'Pipian Rojo', '200g', 3.99, 'images/pipianrojo.jpg', 'Ein netter Kontrast zur Pipian Verde, wird auch der Geschmack der Pipian Rojo dem Gaumen ein Genuss sein.', 'Ancho Chilischoten, Guajillo Chilischoten, KÃ¼rbiskerne, Sesam, Zimt, Tomate, Zwiebel, Knoblauch'),
(39, 'Mole Prieto', '200g', 3.59, 'images/moleprieto.jpg', 'Man wÃ¼rde meinen, es kann doch bald keine Molen mehr geben, tatsÃ¤chlich darf man aber nicht Mole Prieto vergessen, denn lecker ist sie allemal.', 'Zwiebel, Knoblauch, Guajillo Chili, Zimt, Pilze'),
(40, 'Loca Mole', '150g', 4.59, 'images/locamole.jpg', 'Unsere hauseigene Mole nach Geheimrezept. Sie Ã¤hnelt einer Guacamole, hat aber noch eine gewisse Extranote.', 'Avocados, Tomaten, Zitronensaft, Knoblauch, Salz und Pfeffer, Limette, Koriander, Petersilie');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `produkte`
--
ALTER TABLE `produkte`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `produkte`
--
ALTER TABLE `produkte`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
