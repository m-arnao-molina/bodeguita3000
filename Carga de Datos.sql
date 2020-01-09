/*GENERAL*/
INSERT INTO proveedors (id, nombre, email) VALUES
(1, 'Tres Montes S.A.', 'contacto@tresmontes.cl'),
(2, 'Nestle S.A.', 'contacto@nestle.cl'),
(3, 'Cooperativa Lechera La Unión LTDA.', 'contacto@colun.cl'),
(4, 'CCU S.A.', 'contacto@ccu.cl'),
(5, 'The CocaCola Company', 'contacto@cocacola.cl'),
(6, 'Carozzi S.A.', 'contacto@carozzi.cl');

INSERT INTO marcas (id, nombre, proveedor_id) VALUES
(1, 'Lucchetti', 1),
(2, 'Zuko', 1),
(3, 'Nescafé', 2),
(4, 'McKay', 2),
(5, 'COLUN', 3),
(6, 'Pepsi', 4),
(7, '7up', 4),
(8, 'Crush', 4),
(9, 'Coca Cola', 5),
(10, 'Andina del Valle', 5),
(11, 'Fanta', 5),
(12, 'Carozzi', 6),
(13, 'Costa', 6),
(14, 'Ambrosoli', 6);
/*------*/

/*EMPRESA LIDER*/
INSERT INTO empresas (id, nombre, rut) VALUES
(1, 'Lider', '96439000-2');

INSERT INTO sucursals (id, nombre, numero, direccion, telefono, empresa_id) VALUES
(1, 'Estación Central', 1, 'Av. Libertador Bernardo O\'Higgins 5199, local 140', '601 400 9000', 1),
(2, 'Huechuraba', 2, 'Av. Américo Vespucio 1737, local 41', '602 400 9000', 1),
(3, 'Las Condes', 3, 'Camino El Alba 11865, local 88', '603 400 9000', 1),
(4, 'La Reina', 4, 'Jorge Alessandri 1131, local 95', '604 400 9000', 1),
(5, 'La Florida', 5, 'Froilan Roa 7107 Local E-103, local 62', '605 400 9000', 1),
(6, 'Antofagasta', 6, 'Zenteno 21, local 91', '606 400 9000', 1),
(7, 'Calama', 7, 'Balmaceda 3242, local 33', '607 400 9000', 1),
(8, 'Copiapo', 8, 'Av. Chacabuco 120, local 126', '608 400 9000', 1),
(9, 'La Serena', 9, 'Av. Francisco de Aguirre 02, local 92', '609 400 9000', 1),
(10, 'Quilpué', 10, 'Av. Los Carrera 1159, local 84', '610 400 9000', 1),
(11, 'Viña del Mar', 11, '15 Norte 961, local 58', '611 400 9000', 1),
(12, 'Rancagua', 12, 'Av. Pdte.Eduardo Frei Montalva 190, local 35', '612 400 9000', 1),
(13, 'Chillán', 13, 'Av. Collín 6985, local 608', '613 400 9000', 1),
(14, 'Concepción', 14, 'Av. Arturo Prat 651, local 98', '614 400 9000', 1),
(15, 'Concepción, Bío Bío', 15,'Autop. Concepción-Talcachuano 9000, local 89', '615 400 9000', 1),
(16, 'Temuco', 16, 'Av. Prieto Norte 0320, local 96', '616 400 9000', 1),
(17, 'Valdivia', 17, 'Coronel Santiago Bueras 1400, local 94', '617 400 9000', 1),
(18, 'Osorno', 18, 'Av. Alcalde René Soriano 2855, local 618', '618 400 9000', 1),
(19, 'Punta Arenas', 19, 'Av. Eduardo Frei Montalva 01110, local 121', '620 400 9000', 1);

INSERT INTO productos (id, codigo, nombre, cont_neto, precio, marca_id, empresa_id) VALUES
(1, '10000', 'Leche descremada', '1 litro', 529, 5, 1),
(2, '11000', 'Pepsi Normal', '1.5 litros', 900, 6, 1),
(3, '11100', 'Jugo de damasco', '2 litros', 1200, 10, 1),
(4, '11110', 'Tallarines', '200 gramos', 1000, 1, 1),
(5, '11111', 'Tallarines', '200 gramos', 1000, 12, 1),
(6, '10110', 'Tritón Vainilla', '150 gramos', 400, 4, 1),
(7, '10011', 'Frac', '120 gramos', 350, 13, 1),
(8, '10001', 'Jugo de naranja en polvo', '50 gramos', 100, 2, 1);

INSERT INTO producto_sucursals (id, stock_actual, stock_minimo, producto_id, sucursal_id) VALUES
(1, 234, 30, 1, 1), (2, 24, 30, 2, 1), (3, 72, 70, 3, 1), (4, 57, 50, 4, 1),
(5, 60, 50, 5, 1), (6, 30, 15, 6, 1), (7, 36, 12, 7, 1), (8, 244, 300, 8, 1),
(9, 234, 30, 1, 8), (10, 24, 30, 2, 8), (11, 72, 70, 3, 8), (12, 57, 50, 4, 8),
(13, 60, 50, 5, 8), (14, 30, 15, 6, 8), (15, 36, 12, 7, 8), (16, 244, 300, 8, 8),
(17, 234, 30, 1, 11), (18, 24, 30, 2, 11), (19, 72, 70, 3, 11), (20, 57, 50, 4, 11),
(21, 60, 50, 5, 11), (22, 30, 15, 6, 11), (23, 36, 12, 7, 11), (24, 244, 300, 8, 11);

INSERT INTO users (id, email, password, type, habilitado) VALUES /* La contraseña es 'secret' para todos */
(1, 'gerente_general@lider.cl', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'g_general', true),
(2, 'gerente_sucursal_1@lider.cl', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'g_sucursal', true),
(3, 'gerente_sucursal_8@lider.cl', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'g_sucursal', true),
(4, 'gerente_sucursal_11@lider.cl', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'g_sucursal', true),
(5, 'bodeguero_sucursal_1@lider.cl', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'bodeguero', true),
(6, 'bodeguero_sucursal_8@lider.cl', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'bodeguero', true),
(7, 'bodeguero_sucursal_11@lider.cl', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'bodeguero', true),
(8, 'cajero_sucursal_1@lider.cl', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'cajero', true),
(9, 'cajero_sucursal_8@lider.cl', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'cajero', true),
(10, 'cajero_sucursal_11@lider.cl', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'cajero', true);

INSERT INTO gerente_generals (id, rut, p_nombre, p_apellido, empresa_id, user_id) VALUES
(1, '11111111-1', 'Mario', 'Boss', 1, 1);

INSERT INTO gerente_sucursals (id, rut, p_nombre, p_apellido, sucursal_id, user_id) VALUES
(1, '11111110-1', 'Marcos', 'Gajardo', 1, 2),
(2, '11111100-1', 'Jorge', 'Pino', 8, 3),
(3, '11111000-1', 'Ariel', 'Delgado', 11, 4);

INSERT INTO bodegueros (id, rut, p_nombre, p_apellido, sucursal_id, user_id) VALUES
(1, '11110000-1', 'Bernardo', 'Hernández', 1, 5),
(2, '11100000-1', 'Ignacio', 'Rodríguez', 8, 6),
(3, '11000000-1', 'Martín', 'Quezada', 11, 7);

INSERT INTO cajeros (id, rut, p_nombre, p_apellido, sucursal_id, user_id) VALUES
(1, '10000000-1', 'Pedro', 'Norambuena', 1, 8),
(2, '10100000-1', 'Victoria', 'Villarroel', 8, 9),
(3, '10110000-1', 'Claudio', 'Moreno', 11, 10);
/*--------------------*/

/*EMPRESA SANTA ISABEL*/
INSERT INTO empresas (id, nombre, rut) VALUES
(2, 'Santa Isabel', '84671700-5');

INSERT INTO sucursals (id, nombre, numero, direccion, telefono, empresa_id) VALUES
(20, 'Viana, Viña', 1, 'Viana 1215, Viña del Mar', '600 400 2000', 2),
(21, 'Libertad, Viña', 2, 'Av. Libertad 1348, local 305, Viña del Mar', '600 400 2000', 2),
(22, 'Quillota, Viña', 3, 'Quillota 441, Viña del Mar', '600 400 2000', 2),
(23, '1 Poniente, Viña', 4, '1 Poniente 811, Viña del Mar', '600 400 2000', 2),
(24, 'R. Sotomayor, Viña', 5, 'R. Sotomayor 230, Viña del Mar', '600 400 2000', 2),
(25, 'Villanelo, Viña', 6, 'Villanelo 236, Viña del Mar', '600 400 2000', 2),
(26, 'Av. Valparaíso, Viña', 7, 'Av. Valparaíso 740, Viña del Mar', '600 400 2000', 2),
(27, 'Arlegui, Viña', 8, 'Arlegui 948, Viña del Mar', '600 400 2000', 2);

INSERT INTO users (id, email, password, type, habilitado) VALUES /* La contraseña es 'secret' para todos */
(11, 'gerente_general@santaisabel.cl', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'g_general', true),
(12, 'gerente_sucursal_2@santaisabel.cl', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'g_sucursal', true),
(13, 'gerente_sucursal_3@santaisabel.cl', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'g_sucursal', true),
(14, 'gerente_sucursal_4@santaisabel.cl', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'g_sucursal', true),
(15, 'bodeguero_sucursal_2@santaisabel.cl', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'bodeguero', true),
(16, 'bodeguero_sucursal_3@santaisabel.cl', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'bodeguero', true),
(17, 'bodeguero_sucursal_4@santaisabel.cl', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'bodeguero', true),
(18, 'cajero_sucursal_2@santaisabel.cl', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'cajero', true),
(19, 'cajero_sucursal_3@santaisabel.cl', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'cajero', true),
(20, 'cajero_sucursal_4@santaisabel.cl', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'cajero', true);

INSERT INTO gerente_generals (id, rut, p_nombre, p_apellido, empresa_id, user_id) VALUES
(2, '22222222-2', 'Marcelo', 'Cobarrubias', 2, 11);

INSERT INTO gerente_sucursals (id, rut, p_nombre, p_apellido, sucursal_id, user_id) VALUES
(4, '22222220-2', 'José', 'Gallardo', 21, 12),
(5, '22222200-2', 'Leslie', 'Piña', 22, 13),
(6, '22222000-2', 'Michael', 'Diaz', 23, 14);

INSERT INTO bodegueros (id, rut, p_nombre, p_apellido, sucursal_id, user_id) VALUES
(4, '22220000-2', 'Mariano', 'Bahamondez', 21, 15),
(5, '22200000-2', 'Matias', 'Riquelme', 22, 16),
(6, '22000000-2', 'Anibal', 'Mendez', 23, 17);

INSERT INTO cajeros (id, rut, p_nombre, p_apellido, sucursal_id, user_id) VALUES
(4, '20000000-2', 'Ricardo', 'Gonzalez', 21, 18),
(5, '20200000-2', 'Ana', 'Baeza', 22, 19),
(6, '20220000-2', 'Andrea', 'Fierro', 23, 20);
/*--------------------*/