-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: library
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.21-MariaDB-1~jessie

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` VALUES (1,'Михаил Афанасьевич Булгаков','Михаил Булгаков родился 3 (15) мая 1891 года в Киеве в семье профессора Киевской духовной академии Афанасия Ивановича Булгакова (1859—1907) и его жены Варвары Михайловны (в девичестве — Покровской) (1869—1922). В семье было семеро детей: Михаил (1891—1940), Вера (1892—1972), Надежда (1893—1971), Варвара (1895—1954), Николай (1898—1966), Иван (1900—1969) и Елена (1902—1954). ','http://www.100bestbooks.ru/pictures/autors/bulgakov.jpg'),(2,'Лев Николаевич Толстой','Родился 28 августа 1828 года в Крапивенском уезде Тульской губернии, в наследственном имении матери — Ясной Поляне. Был 4-м ребёнком; его три старших брата: Николай (1823—1860), Сергей (1826—1904) и Дмитрий (1827—1856). В 1830 году родилась сестра Мария (1830—1912). Его мать умерла, когда ему не было ещё 2-х лет. ','http://www.100bestbooks.ru/pictures/autors/ltolstoy.jpg'),(3,'Федор Михайлович Достоевский','Фёдор Михайлович Достоевский родился 30 октября (11 ноября) 1821 года в Москве. Отец, Михаил Андреевич, работал в госпитале для бедных. Мать, Мария Фёдоровна (в девичестве Нечаева), происходила из купеческого рода. Фёдор был вторым из 7 детей. По одному из предположений, Достоевский происходит по отцовской линии из пинской шляхты, чьё родовое имение Достоево в XVI—XVII веках находилось в белорусском Полесье (ныне Ивановский район Брестской области, Белоруссия). Это имение 6 октября 1506 года за заслуги получил во владение от князя Фёдора Ивановича Ярославича Данила Иванович Ртищев. С этого времени Ртищев и его наследники стали именоваться Достоевскими. ','http://www.100bestbooks.ru/pictures/autors/Dostoevsky_1872.jpg'),(5,'Александр Сергеевич Пушкин','Наше все','http://www.100bestbooks.ru/pictures/autors/Pushkin.jpg'),(6,'Николай Васильевич Гоголь','','http://www.100bestbooks.ru/pictures/autors/NikolayGogol.gif');
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` text,
  `photo` varchar(255) DEFAULT NULL,
  `copies` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias_UNIQUE` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` VALUES (4,'Мастер и Маргарита','master','\"Мастер и Маргарита\" - итоговое произведение выдающегося отечественного прозаика и драматурга Михаила Афанасьевича Булгакова. \r\n\r\nОбещание, содержащееся на страницах книги - \"ваш роман вам принесет еще сюрпризы\", - оправдалось вполне: написанный Мастером провидческий роман о дьяволе, пожалуй, явился одной из самых загадочных, удивительных и самых читаемых книг XX столетия! Многие слова и выражения из этого произведения вошли в современный лексикон, а персонажи своею реальностью затмили действительно существующих граждан.','',2),(5,'Ревизор','revizor','«Ревизор» — одна из лучших русских комедий. Н.В. Гоголь заставил современников смеяться над тем, к чему они привыкли и что перестали замечать. И сегодня комедия, созданная великим русским писателем, продолжая звучать современно, указывает путь к нравственному возрождению.','http://www.100bestbooks.ru/pictures/books/Nikolai_Gogol_Revizor.jpg',5),(6,'Вечера на хуторе близ Диканьки','dykanka','«Вечера на хуторе близ Диканьки» (Часть первая – 1831, Часть вторая – 1832) – бессмертный шедевр великого русского писателя Николая Васильевича Гоголя (1809—1852). \r\n\r\nВосторженно принятая современниками (так, например, А.С. Пушкин писал: «Сейчас прочел „Вечера на хуторе близ Диканьки“. Они изумили меня. Вот настоящая веселость, искренняя, непринужденная, без жеманства, без чопорности. А местами, какая поэзия. Какая чувственность! Все это так необыкновенно в нашей литературе, что я доселе не образумился…»), эта книга и сегодня остается одним из любимейших читателями произведений писателя.','',3),(7,'Игрок','player','Это — «Игрок». \r\n\r\nПроизведение жесткое до жестокости, нервное до неровности и искреннее — уже до душевной обнаженности. \r\n\r\nЭто — своеобразная «история обыкновенного безумия» по-достоевски. \r\n\r\nИстория азарта, ставшего для человека уже не смыслом игры и даже не смыслом жизни, но — единственной, экзистенциальной сутью бытия. \r\n\r\nЭто — «Игрок». \r\n\r\nИ это — возможно, единственная «автобиографическая» книга Достоевского.','',0),(8,'Воскресение','sunday','«Воскресение» — шедевр позднего творчества Льва Толстого. \r\n\r\nИстория уставшего от светской жизни и развлечений аристократа, переживающего внезапное духовное прозрение при трагической встрече с циничной «жрицей любви», которую он сам некогда толкнул на этот печальный путь. \r\n\r\nИстория болезненной, мучительной переоценки ценностей и долгого трудного очищения… \r\n\r\nПо мнению литературных критиков, этот роман является вершиной реализма Льва Толстого','',0),(9,'Капитанская дочка','captains-daughter','В романе «Капитанская дочка» А.С.Пушкин нарисовал яркую картину стихийного крестьянского восстания под предводительством Емельяна Пугачева. \r\n\r\nПроизведение включено в школьную программу и рекомендовано для внеклассного чтения. \r\n\r\nДля детей среднего и старшего школьного возраста.','',0),(10,'Тарас Бульба','taras','Известная повесть Н.В.Гоголя из цикла «Миргород», при создании которой автор широко использовал различные исторические источники: мемуары, летописи, исследования, фольклорные материалы. \r\n«Тарас Бульба» давно входит в школьную программу. Но хорошо бы иметь в виду, что для прочтения этой повести нужна мудрость, редко свойственная юному возрасту. Впрочем, наверное, это лишнее замечание: с классикой всегда так бывает.','',0),(11,'Бесы','demon','Уже были написаны «Записки из Мертвого дома», «Записки из подполья», «Преступление и наказание», «Идиот», а Достоевский все еще испытывал острое чувство неудовлетворенности и, по собственному признанию, только подбирался к главному своему произведению, перед которым вся «прежняя литературная карьера — была только дрянь и введение». Однако в политической жизни России случилось нечто, заставившее Достоевского изменить свои литературные планы и приступить к созданию романа с вызывающим и символичным названием «Бесы». Спиралеобразное развитие истории вообще и российской истории в частности позволяет думать, что роман Достоевского «Бесы» будет интересен новым поколениям читателей не только как шедевр классической литературы.','',0),(12,'Собачье сердце','dogs-heart','«Собачье сердце» – одно из самых любимых читателями произведений Михаила Булгакова. Вас ждёт полный рассказ о необыкновенном эксперименте гениального доктора.','http://www.100bestbooks.ru/pictures/books/Dog_heart.jpg',0),(13,'Евгений Онегин','eugene-onegin','Роман в стихах «Евгений Онегин» стал центральным событием в литературной жизни пушкинской поры. И с тех пор шедевр А.С.Пушкина не утратил своей популярности, по-прежнему любим и почитаем миллионами читателей.','http://www.100bestbooks.ru/pictures/books/onegin.jpg',0),(14,'Мёртвые души','dead-souls','«…Говоря о „Мертвых душах“, можно вдоволь наговориться о России», – это суждение поэта и критика П. А. Вяземского объясняет особое место поэмы Гоголя в истории русской литературы: и огромный успех у читателей, и необычайную остроту полемики вокруг главной гоголевской книги, и многообразие высказанных мнений, каждое из которых так или иначе вовлекает в размышления о природе национального мышления и культурного сознания, о настоящем и будущем России.','http://www.100bestbooks.ru/pictures/books/Dead_Souls_Gogol_1842.jpg',0),(15,'Идиот','idiot','Роман, в котором творческие принципы Достоевского воплощаются в полной мере, а удивительное владение сюжетом достигает подлинного расцвета. Яркая и почти болезненно талантливая история несчастного князя Мышкина, неистового Парфена Рогожина и отчаявшейся Настасьи Филипповны, много раз экранизированная и поставленная на сцене, и сейчас завораживает читателя…','http://www.100bestbooks.ru/pictures/books/idiot.jpg',0),(16,'Анна Каренина','anna','«Анна Каренина», один из самых знаменитых романов Льва Толстого, начинается ставшей афоризмом фразой: «Все счастливые семьи похожи друг на друга, каждая несчастливая семья несчастлива по-своему». Это книга о вечных ценностях: о любви, о вере, о семье, о человеческом достоинстве.','http://www.100bestbooks.ru/pictures/books/AnnaKarenina.jpg',0),(17,'Братья Карамазовы','karamazovi','Самый сложный, самый многоуровневый и неоднозначный из романов Достоевского, который критики считали то «интеллектуальным детективом», то «ранним постмодернизмом», то — «лучшим из произведений о загадочной русской душе». \r\n\r\nРоман, легший в основу десятков экранизаций — от предельно точных до самых отвлеченных, — но не утративший своей духовной силы…','http://www.100bestbooks.ru/pictures/books/Dostoevsky_Brothers_Karamazovs.jpg',0),(18,'Преступление и наказание','crime-and-punishment','«Преступление и наказание» (1866) — роман об одном преступлении. Двойное убийство, совершенное бедным студентом из-за денег. Трудно найти фабулу проще, но интеллектуальное и душевное потрясение, которое производит роман, — неизгладимо. В чем здесь загадка? Кроме простого и очевидного ответа — «в гениальности Достоевского» — возможно, существует как минимум еще один: «проклятые» вопросы не имеют простых и положительных ответов. Нищета, собственные страдания и страдания близких всегда ставили и будут ставить человека перед выбором: имею ли я право преступить любой нравственный закон, чтобы потом стать спасителем униженных и утешителем слабых; должен ли я сперва возлюбить себя, а только потом, став сильным, возлюбить ближнего своего? Это вечные вопросы.','http://www.100bestbooks.ru/pictures/books/crime_and_punishment.jpg',0),(19,'Война и мир','war-and-peace','Роман-эпопея, описывающий события войн против Наполеона: 1805 года и отечественной 1812 года. Признан критикой всего мира величайшим эпическим произведением литературы нового времени.','http://www.100bestbooks.ru/pictures/books/War-and-peace_1873.gif',0),(20,'Бедные люди','poor-people','\"Бедные люди\" - это первое произведение Ф.М.Достоевского, которое предопределило будущую литературную судьбу писателя как величайшего психолога, способного глубоко проникнуть во внутренний мир своего героя и передать неуловимые нюансы состояния его души. По словам В.Г.Белинского роман отличается \"глубоким пониманием и художественным, в полном смысле слова, воспроизведением трагической стороны жизни\". В \"Бедных людях\", так же как и в гоголевской \"Шинели\" звучит \"вечная тема\" российской литературы - тема \"маленького человека\", ощущающего свое бессилие перед тяготами жизни.','http://www.100bestbooks.ru/pictures/books/Poor_Folk.png',0),(21,'Повести Белкина','belkin','Цикл повестей Александра Сергеевича Пушкина, состоящий из 5 повестей и выпущенный им без указания имени настоящего автора, то есть самого Пушкина. \r\n\r\nКнига состоит из предисловия издателя и пяти повестей: \r\n\r\n«Выстрел» \r\n«Метель» \r\n«Гробовщик» \r\n«Станционный смотритель» \r\n«Барышня-крестьянка» ','',0),(22,'Дубровский','dubrovsky','В «Дубровском» Пушкин с присущим ему реализмом отразил широкую картину жизни русского провинциального дворянства и общественную ситуацию, типичную для пушкинской современности. \r\n\r\nЗахватывающий сюжет «Дубровского» держит в напряжении от начала и до конца. Судьба «благородного разбойника», который с помощью оружия пытается восстановить справедливость и освободить любимую женщину из плена ненавистного замужества, никого не оставляет равнодушным.','',0),(23,'Униженные и оскорблённые','insulted-and-injured','«Униженные и оскорбленные» (1861) — по определению Ф. Достоевского, «роман из петербургского быта» — произведение, в котором изображены страдания «маленьких людей», резкие социальные контрасты современной писателю жизни.','http://www.100bestbooks.ru/pictures/books/Dostoevskyi_Unizhennye_i_oskirblennye.jpg',0),(24,'Белая гвардия','white-guard','\"Белая гвардия\" - один из самых известных романов М.А.Булгакова. Действие его разворачивается в Киеве, втянутом в кровавый водоворот Гражданской войны. Однако в \"Белой гвардии\" рассказ о трагической судьбе одной дворянской семьи перерастает в видение вселенской катастрофы, в которой гибнет не только старый мир, но и вечные ценности культуры и цивилизации.','http://www.100bestbooks.ru/pictures/books/Bulgakov_Belaya_gvardiya.jpg',0);
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book_at_author`
--

DROP TABLE IF EXISTS `book_at_author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_at_author` (
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`book_id`,`author_id`),
  KEY `fk_book_at_author_author` (`author_id`),
  CONSTRAINT `fk_book_at_author_author` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_book_at_author_book` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_at_author`
--

LOCK TABLES `book_at_author` WRITE;
/*!40000 ALTER TABLE `book_at_author` DISABLE KEYS */;
INSERT INTO `book_at_author` VALUES (4,1),(5,6),(6,5),(6,6),(7,3),(8,2),(9,5),(10,6),(11,3),(12,1),(13,5),(14,6),(15,3),(16,2),(17,3),(18,3),(19,2),(20,3),(21,5),(22,5),(23,3),(24,1);
/*!40000 ALTER TABLE `book_at_author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book_at_tag`
--

DROP TABLE IF EXISTS `book_at_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_at_tag` (
  `book_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`book_id`,`tag_id`),
  KEY `fk_book_at_tag_tag` (`tag_id`),
  CONSTRAINT `fk_book_at_tag_book` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_book_at_tag_tag` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_at_tag`
--

LOCK TABLES `book_at_tag` WRITE;
/*!40000 ALTER TABLE `book_at_tag` DISABLE KEYS */;
INSERT INTO `book_at_tag` VALUES (4,2),(4,3),(4,13),(4,15),(5,9),(6,3),(6,4),(6,5),(7,2),(7,3),(8,3),(9,2),(9,3),(10,5),(11,2),(11,3),(12,3),(12,5),(13,1),(13,2),(13,3),(14,3),(14,7),(14,10),(15,3),(16,3),(17,3),(18,2),(18,3),(19,2),(19,3),(20,3),(21,3),(21,4),(21,5),(22,2),(22,3),(23,2),(23,3),(24,3);
/*!40000 ALTER TABLE `book_at_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book_at_user`
--

DROP TABLE IF EXISTS `book_at_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_at_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `limit_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `receipt_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_book_at_user_user_idx` (`user_id`),
  KEY `fk_book_at_user_book_idx` (`book_id`),
  KEY `return_idx` (`return_date`),
  CONSTRAINT `fk_book_at_user_book` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_book_at_user_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_at_user`
--

LOCK TABLES `book_at_user` WRITE;
/*!40000 ALTER TABLE `book_at_user` DISABLE KEYS */;
INSERT INTO `book_at_user` VALUES (1,4,1,'2017-02-04',NULL,'2017-02-01'),(2,4,1,'2017-02-23','2017-02-11','2017-02-11'),(3,4,1,'2017-02-16',NULL,'2017-02-11'),(4,6,2,'2017-02-18',NULL,'2017-02-12');
/*!40000 ALTER TABLE `book_at_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `text_message` text,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_user_idx` (`user_id`),
  CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (13,1,'Текст сообщения должника','2017-02-12 22:07:57'),(14,2,'Сообщение читателя','2017-02-12 22:09:49');
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias_UNIQUE` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES (1,'Поэзия','poetry'),(2,'Роман','romance'),(3,'Классика','classical'),(4,'Сборник','collection'),(5,'Повесть','story'),(6,'Сказка','tale'),(7,'Поэма','poem'),(8,'Трагедия','tragedy'),(9,'Пьеса','play'),(10,'Проза','prose'),(11,'Комедия','comedy'),(12,'Мистика','mystery'),(13,'Сатира','satire'),(14,'Биография','biography'),(15,'Фантастика','fantastic');
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `auth_key` varchar(200) DEFAULT NULL,
  `status` enum('reader','librarian') NOT NULL DEFAULT 'reader',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `email_idx` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Иван','Иванов','zxc@cvb.ru','$2y$13$.2JKDwciPFwYobMq/xQoAOAI5oX8LcmPhqLtyG1ZY3hR7mDAKC5KS','jVd_oyOWUywgd1ACK4EJrAoWl92JEiPw','librarian'),(2,'Joe','Black','zxv@uuu.ru','$2y$13$NQGP4u0lcmwAUD061RPLbuFQeDangmh8T2fFD6TK.7huQldlUoJBW','8B1bOWY-9LkYYpvH7uJroNAzndsFK0Jv','reader');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-02-13  3:14:39
