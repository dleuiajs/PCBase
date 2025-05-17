INSERT INTO graficka_karta (nazov, model, typ_pamati, velkost_pamati, zbernica, taktny_rychlost, rozhranie, napajanie) 
VALUES 
("Sapphire PULSE AMD Radeon RX-550 GAMING 2GB GDDR5", "Radeon RX 550", "GDDR5", 2, 64, 1206, "PCI Express 3.0", 400),
("ASUS NVIDIA GeForce GT1030-2G-BRK", "NVIDIA GeForce GT1030", "GDDR5", 2, 64, 1506, "PCI Express 3.0", 300),
("ASRock AMD Radeon RX 6600 Challenger D 8GB", "Radeon RX 6600", "GDDR6", 8, 128, 2491, "PCI Express 4.0", 500),
("ASUS TURBO GeForce GTX 1080Ti 11GB", "NVIDIA GeForce GTX 1080 Ti", "GDDR5X", 11, 352, 1480, "PCI Express 3.0 x16", 600),
("GIGABYTE NVIDIA GeForce RTX 3060 GAMING OC 8G LHR, 8GB GDDR6", "NVIDIA GeForce RTX 3060", "GDDR5X", 8, 128, 1807, "PCI Express 4.0", 550),
("Sapphire AMD Radeon RX 7900 XT PURE 20GB", "Radeon RX 7900 XT", "GDDR5X", 20, 320, 2075, "PCI Express 4.0", 750),
("ASUS TUF Gaming GeForce RTX 4070 SUPER 12GB GDDR6X OC Edition DLSS 3", "NVIDIA GeForce RTX 4070 SUPER", "GDDR6X", 12, 192, 2670, "PCI Express 4.0", 750),
("MSI GeForce RTX 5090 32G GAMING TRIO OC", "NVIDIA GeForce RTX 5090", "GDDR7", 32, 512, 2017, "PCIe 5.0 x16", 575);
INSERT INTO zakladna_doska (nazov, model, socket, chipset, pocet_pameti_slots, form_factor) 
VALUES 
("MSI H310M PRO-VDH PLUS", "MSI H310M PRO-VDH PLUS", "Intel 1151", "Intel H310", 2, "mATX (Micro ATX)"), 
("ASRock B450M-HDV R4.0", "ASRock B450M-HDV R4.0", "AMD AM4", "AMD B450", 2, "mATX (Micro ATX)"), 
("ASRock H510-HVS", "ASRock H510-HVS", "LGA 1200", "Intel H510", 2, "mATX (Micro ATX)"),
("TUF GAMING B550-PLUS AM4 DDR4 HDMI", "TUF Gaming B550-Plus", "AM4", "AMD B550", 4, "ATX"), 
("MSI Z790 GAMING PLUS WIFI", "MSI Z790 GAMING PLUS WIFI", "LGA1700", "Intel Z790", 4, "ATX"), 
("ASUS ROG STRIX B550-F GAMING", "ROG Strix B550-F Gaming", "AM4", "AMD B550", 4, "ATX"), 
("GIGABYTE Z490 AORUS ELITE AC", "Z490 AORUS ELITE AC", "LGA1200", "Intel Z490", 4, "ATX"), 
("MSI MAG B550M MORTAR WIFI", "MAG B550M MORTAR WIFI", "AM4", "AMD B550", 4, "mATX (Micro ATX)"),
("ASRock X570 Taichi", "X570 Taichi", "AM4", "AMD X570", 4, "ATX"), 
("ASUS ROG CROSSHAIR VIII HERO (WI-FI)", "ROG Crosshair VIII Hero (Wi-Fi)", "AM4", "AMD X570", 4, "ATX");
INSERT INTO procesor (nazov, model, jadra, vlaken, taktny_rychlost, socket, TDP) 
VALUES 
("Intel Pentium Gold G6400", "Intel Pentium Gold G6400", 2, 4, 4.00, "FCLGA1200", 58),
("Intel Celeron G5900", "Intel Celeron G5900", 2, 2, 3.40, "FCLGA1200", 58),
("Intel Core 2 Duo E8400", "Intel Core 2 Duo E8400", 2, 2, 3.00, "LGA775", 65),
("Intel Core i3-10105F", "Intel Core i3-10105F", 4, 8, 4.40, "FCLGA1200", 65),
("Intel Core i5-12600KF", "Intel Core i5-12600KF", 10, 16, 4.90, "FCLGA1700", 125),
("Intel Core i9-13900KF", "Intel Core i9-13900KF", 24, 32, 5.70, "FCLGA1700", 125),
("AMD Ryzen 3 3200G", "AMD Ryzen 3 3200G", 4, 4, 4.00, "AM4", 65),
("AMD Athlon 64 X2 4800+", "AMD Athlon 64 X2 4800+", 2, 2, 2.40, "939", 65),
("AMD Ryzen 5 5600X", "AMD Ryzen 5 5600X", 6, 12, 4.60, "AM4", 65),
("AMD Ryzen 9 7900X", "AMD Ryzen 9 7900X", 12, 24, 5.60, "AM5", 170);
INSERT INTO `pcbase`.`operacna_pamat` (`nazov`, `model`, `typ_pamati`, `kapacita`, `rychlost`, `napatie`) VALUES
('Kingston ValueRAM DDR2 2x2GB', 'KVR800D2N6K2/4G', 'DDR2', 4.0, 800, 1.8),
('Corsair XMS2 2x2GB', 'CM2X2048-6400C4', 'DDR2', 4.0, 800, 1.9),
('Corsair Vengeance DDR3 2x4GB', 'CM3X4GSD1600C9', 'DDR3', 8.0, 1600, 1.5),
('Kingston HyperX DDR3 2x4GB', 'KHX1600C9D3K2/8GX', 'DDR3', 8.0, 1600, 1.65),
('Corsair Vengeance LPX DDR4 1x8GB', 'CMK8GX4M1A2133C13', 'DDR4', 8.0, 2133, 1.2),
('G.Skill Ripjaws V DDR4 2x8GB', 'F4-3600C16D-16GVKC', 'DDR4', 16.0, 3600, 1.35),
('Corsair Vengeance LPX DDR4 2x8GB', 'CMK16GX4M2B3000C15', 'DDR4', 16.0, 3000, 1.35),
('Kingston Fury Beast DDR4 2x16GB', 'KF436C16BBK2/32', 'DDR4', 32.0, 3600, 1.35),
('Corsair Vengeance DDR5 2x16GB', 'CMH32GX5M2D6000C36', 'DDR5', 32.0, 6000, 1.1),
('G.Skill Trident Z5 DDR5 2x8GB', 'F5-6000U3036E16GX2-TZ5', 'DDR5', 16.0, 6000, 1.1);
INSERT INTO `pcbase`.`napajaci_zdroj` (`nazov`, `model`, `vystupny_vykon`, `efektivita`, `typ_konektora`, `ochrana`, `format`) VALUES
('Corsair RM850x', 'CP-9020180-NA', 850, '80+ Gold', '24-pin ATX, 4+4 CPU, 6+2 PCIe, SATA, Molex', 'Over-voltage, Over-current, Over-power, Short-circuit', 'ATX'),
('Seasonic Focus GX-850', 'SSR-850FX', 850, '80+ Gold', '24-pin ATX, 4+4 CPU, 6+2 PCIe, SATA, Molex', 'Over-voltage, Over-current, Over-power, Short-circuit', 'ATX'),
('EVGA SuperNOVA 750 G5', '220-G5-0750-X1', 750, '80+ Gold', '24-pin ATX, 4+4 CPU, 6+2 PCIe, SATA, Molex', 'Over-voltage, Over-current, Over-power, Short-circuit', 'ATX'),
('Cooler Master MWE Gold 750W', 'MPY-7501-ACAAG', 750, '80+ Gold', '24-pin ATX, 4+4 CPU, 6+2 PCIe, SATA, Molex', 'Over-voltage, Over-current, Over-power, Short-circuit', 'ATX'),
('Thermaltake Toughpower GF1 650W', 'PS-TPG-0650FNFAGU-1', 650, '80+ Gold', '24-pin ATX, 4+4 CPU, 6+2 PCIe, SATA, Molex', 'Over-voltage, Over-current, Over-power, Short-circuit', 'ATX'),
('be quiet! Straight Power 11 750W', 'BN314', 750, '80+ Platinum', '24-pin ATX, 4+4 CPU, 6+2 PCIe, SATA, Molex', 'Over-voltage, Over-current, Over-power, Short-circuit', 'ATX'),
('Corsair CV550', 'CP-9020223-NA', 550, '80+ Bronze', '24-pin ATX, 4+4 CPU, 6+2 PCIe, SATA, Molex', 'Over-voltage, Over-current, Over-power, Short-circuit', 'ATX'),
('XPG Pylon 650W', 'PYL650W', 650, '80+ Bronze', '24-pin ATX, 4+4 CPU, 6+2 PCIe, SATA, Molex', 'Over-voltage, Over-current, Over-power, Short-circuit', 'ATX'),
('Antec EarthWatts Gold Pro 650W', 'EA-650G PRO', 650, '80+ Gold', '24-pin ATX, 4+4 CPU, 6+2 PCIe, SATA, Molex', 'Over-voltage, Over-current, Over-power, Short-circuit', 'ATX'),
('SilverStone Strider Gold S 750W', 'SST-ST75F-GS', 750, '80+ Gold', '24-pin ATX, 4+4 CPU, 6+2 PCIe, SATA, Molex', 'Over-voltage, Over-current, Over-power, Short-circuit', 'ATX');
INSERT INTO `pcbase`.`ulozisko` (`nazov`, `model`, `typ`, `kapacita`, `rychlost_prenosu`, `interface`, `rotacia`, `format`, `typ_pameti`) VALUES
('Samsung 970 EVO Plus 1TB', 'MZ-V7S1T0B/AM', 'SSD', 1024, 3500, 'M.2 NVMe', NULL, 'M.2', 'NAND Flash'),
('Crucial MX500 1TB', 'CT1000MX500SSD1', 'SSD', 1000, 560, 'SATA III', NULL, '2.5"', 'NAND Flash'),
('Western Digital Black SN850 1TB', 'WDS100T1X0E', 'SSD', 1000, 7000, 'M.2 NVMe', NULL, 'M.2', '3D NAND'),
('Seagate Barracuda 2TB 7200', 'ST2000DM008', 'HDD', 2000, 160, 'SATA III', 7200, '3.5"', NULL),
('Toshiba X300 4TB 7200', 'HDWE140XZSTA', 'HDD', 4000, 200, 'SATA III', 7200, '3.5"', NULL),
('Kingston A2000 1TB', 'SA2000M8/1000G', 'SSD', 1000, 2200, 'M.2 NVMe', NULL, 'M.2', 'NAND Flash'),
('Samsung 860 EVO 1TB', 'MZ-76E1T0B/AM', 'SSD', 1000, 550, 'SATA III', NULL, '2.5"', 'NAND Flash'),
('Seagate FireCuda 520 1TB', 'ZP1000GM3A023', 'SSD', 1000, 5000, 'M.2 NVMe', NULL, 'M.2', '3D NAND'),
('WD Red Plus 2TB 5400', 'WD20EFAX', 'HDD', 2000, 180, 'SATA III', 5400, '3.5"', NULL),
('Intel Optane 905P 480GB', 'SSDPE21D480GAX1', 'SSD', 480, 2500, 'PCIe', NULL, '2.5"', 'Optane');
INSERT INTO `pcbase`.`chladenie` (`nazov`, `model`, `typ`, `velkost_fan`, `hlucnost`, `rozmery`) VALUES
('Cooler Master Hyper 212 EVO', 'RR-212E-16PK-R1', 'Vzduchové chladenie', '120 mm', '36 dB', '159 x 119 x 80 mm'),
('Noctua NH-D15', 'NH-D15', 'Vzduchové chladenie', '140 mm', '24.6 dB', '165 x 150 x 161 mm'),
('be quiet! Dark Rock Pro 4', 'BK022', 'Vzduchové chladenie', '135 mm', '24.3 dB', '163 x 140 x 136 mm'),
('Corsair iCUE H100i Elite Capellix', 'CW-9060048-WW', 'Kvapalinové chladenie', '120 mm', '20 dB', '276 x 120 x 27 mm'),
('NZXT Kraken Z73', 'RL-KRZ73-01', 'Kvapalinové chladenie', '120 mm', '21 dB', '394 x 120 x 27 mm'),
('Arctic Liquid Freezer II 240', 'ACFRE00072A', 'Kvapalinové chladenie', '120 mm', '25 dB', '277 x 120 x 38 mm'),
('Thermaltake Floe DX RGB 240', 'CL-W275-PL00BL-A', 'Kvapalinové chladenie', '120 mm', '28 dB', '278 x 120 x 38 mm'),
('Deepcool GAMMAXX 400', 'DP-MCH4-GMX400', 'Vzduchové chladenie', '120 mm', '30 dB', '159 x 121 x 80 mm'),
('Scythe Mugen 5 Rev.B', 'SCMG-5100', 'Vzduchové chladenie', '120 mm', '25.5 dB', '154 x 136 x 110 mm'),
('Corsair iCUE H150i Elite Capellix', 'CW-9060049-WW', 'Kvapalinové chladenie', '120 mm', '20 dB', '397 x 120 x 27 mm');
INSERT INTO `pcbase`.`operacny_system` (`nazov`) VALUES
('Windows XP Home Edition'),
('Windows Vista Home Premium'),
('Windows 7 Professional'),
('Windows 10 Pro'),
('Windows 11 Pro'),
('Ubuntu 18.04 LTS'),
('Ubuntu 20.04 LTS'),
('Ubuntu 22.04 LTS'),
('Debian 10 Buster'),
('Debian 11'),
('Fedora 28'),
('Fedora 35');
INSERT INTO rola (nazov) VALUES
("Používateľ"),
("Správca zostáv počítačov"),
("Správca kontaktných požiadaviek"),
("Správca produktov"),
("Správca");