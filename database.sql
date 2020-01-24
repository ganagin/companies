CREATE TABLE buildings (
  id int(11) unsigned auto_increment primary key,
  address varchar(255) NOT NULL,
  coordinate POINT NOT NULL,
  FULLTEXT(address),
  SPATIAL INDEX `SPATIAL` (`coordinate`)
) ENGINE=InnoDB;

CREATE TABLE companies (
  id int(11) unsigned auto_increment primary key,
  buildingId int(11) unsigned NOT NULL,
  name varchar(255) NOT NULL,
  FOREIGN KEY (buildingId) REFERENCES buildings(id) ON DELETE CASCADE,
  FULLTEXT(name),
  INDEX(buildingId)
) ENGINE=InnoDB;

CREATE TABLE phones (
  id int(11) unsigned auto_increment primary key,
  companyId int(11) unsigned NOT NULL,
  phone varchar(20) NOT NULL,
  FOREIGN KEY (companyId) REFERENCES companies(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE categories (
  id int(11) unsigned auto_increment primary key,
  parentId int(11) unsigned NULL,
  name varchar(100) NOT NULL,
  FOREIGN KEY (parentId) REFERENCES categories(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE companyCategories (
  id int(11) unsigned auto_increment primary key,
  companyId int(11) unsigned NOT NULL,
  categoryId int(11) unsigned NOT NULL,
  FOREIGN KEY (companyId) REFERENCES companies(id) ON DELETE CASCADE,
  FOREIGN KEY (categoryId) REFERENCES categories(id) ON DELETE CASCADE,
  INDEX(companyId, categoryId)
) ENGINE=InnoDB;

INSERT buildings SET address='Красный Проспект 1', coordinate=POINT(55.001, 82.001);
INSERT buildings SET address='Красный Проспект 2', coordinate=POINT(55.002, 82.002);
INSERT buildings SET address='Красный Проспект 3', coordinate=POINT(55.003, 82.003);
INSERT buildings SET address='Ленина 1', coordinate=POINT(55.004, 82.004);
INSERT buildings SET address='Ленина 2', coordinate=POINT(55.005, 82.005);
INSERT buildings SET address='Ленина 3', coordinate=POINT(55.006, 82.006);

INSERT categories SET parentId=NULL, name='Еда';
INSERT categories SET parentId=1, name='Полуфабрикаты оптом';
INSERT categories SET parentId=1, name='Мясная продукция';
INSERT categories SET parentId=NULL, name='Автомобили';
INSERT categories SET parentId=4, name='Грузовые';
INSERT categories SET parentId=4, name='Легковые';
INSERT categories SET parentId=6, name='Запчасти для подвески';
INSERT categories SET parentId=6, name='Шины/Диски';
INSERT categories SET parentId=NULL, name='Спорт';

INSERT companies SET buildingId=1, name='Planet Express';
INSERT companies SET buildingId=1, name='Разное';
INSERT companies SET buildingId=2, name='Одинаковое';
INSERT companies SET buildingId=4, name='Компания';

INSERT phones SET companyId=1, phone='71111111111';
INSERT phones SET companyId=1, phone='72222222222';
INSERT phones SET companyId=2, phone='73333333333';
INSERT phones SET companyId=3, phone='74444444444';
INSERT phones SET companyId=4, phone='75555555555';

INSERT companyCategories SET companyId=1, categoryId=1;
INSERT companyCategories SET companyId=1, categoryId=2;
INSERT companyCategories SET companyId=1, categoryId=4;
INSERT companyCategories SET companyId=1, categoryId=6;
INSERT companyCategories SET companyId=1, categoryId=7;
INSERT companyCategories SET companyId=2, categoryId=1;
INSERT companyCategories SET companyId=2, categoryId=9;
INSERT companyCategories SET companyId=3, categoryId=9;
INSERT companyCategories SET companyId=4, categoryId=9;
