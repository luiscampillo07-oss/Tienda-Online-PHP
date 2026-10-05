-- 1. Crear la base de datos
CREATE DATABASE tienda_db;
USE tienda_db; -- En PostgreSQL para conectarse a la BD (o 'USE tienda_db;' en MySQL)

-- 2. Tabla CATEGORIA (con relación recursiva para subcategorías)
CREATE TABLE Categoria (
    ID_Categoria INT AUTO_INCREMENT PRIMARY KEY, -- Usar SERIAL PRIMARY KEY en PostgreSQL
    Nombre VARCHAR(100) NOT NULL,
    Descripcion TEXT,
    ID_CategoriaPadre INT NULL,
    CONSTRAINT FK_CategoriaPadre FOREIGN KEY (ID_CategoriaPadre) 
        REFERENCES Categoria(ID_Categoria) ON DELETE SET NULL
);

-- 3. Tabla PRODUCTO
CREATE TABLE Producto (
    ID_Producto INT AUTO_INCREMENT PRIMARY KEY, -- Usar SERIAL PRIMARY KEY en PostgreSQL
    Nombre VARCHAR(150) NOT NULL,
    Descripcion TEXT,
    Precio FLOAT NOT NULL CHECK (Precio >= 0),
    Stock INT NOT NULL DEFAULT 0 CHECK (Stock >= 0),
    ID_Categoria INT NOT NULL,
    CONSTRAINT FK_Producto_Categoria FOREIGN KEY (ID_Categoria) 
        REFERENCES Categoria(ID_Categoria) ON DELETE RESTRICT
);

-- 4. Tabla CLIENTE
CREATE TABLE Cliente (
    ID_Cliente INT AUTO_INCREMENT PRIMARY KEY, -- Usar SERIAL PRIMARY KEY en PostgreSQL
    Nombre VARCHAR(100) NOT NULL,
    Apellidos VARCHAR(100) NOT NULL,
    Email VARCHAR(150) UNIQUE NOT NULL,
    Telefono VARCHAR(20),
    Direccion TEXT
);

-- 5. Tabla PEDIDO (Cabecera)
CREATE TABLE Pedido (
    ID_Pedido INT AUTO_INCREMENT PRIMARY KEY, -- Usar SERIAL PRIMARY KEY en PostgreSQL
    Fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Estado VARCHAR(50) DEFAULT 'Pendiente' CHECK (Estado IN ('Pendiente', 'Pagado', 'Enviado', 'Entregado', 'Cancelado')),
    Total DECIMAL(10, 2) DEFAULT 0.00 CHECK (Total >= 0),
    ID_Cliente INT NOT NULL,
    CONSTRAINT FK_Pedido_Cliente FOREIGN KEY (ID_Cliente) 
        REFERENCES Cliente(ID_Cliente) ON DELETE RESTRICT
);

-- 6. Tabla LINEAPEDIDO (Detalle / Tabla intermedia)
CREATE TABLE LineaPedido (
    ID_Linea INT AUTO_INCREMENT PRIMARY KEY, -- Usar SERIAL PRIMARY KEY en PostgreSQL
    ID_Pedido INT NOT NULL,
    ID_Producto INT NOT NULL,
    Cantidad INT NOT NULL CHECK (Cantidad > 0),
    PrecioUnitario DECIMAL(10, 2) NOT NULL CHECK (PrecioUnitario >= 0),
    Subtotal DECIMAL(10, 2) GENERATED ALWAYS AS (Cantidad * PrecioUnitario) STORED, -- Cálculo automático
    CONSTRAINT FK_Linea_Pedido FOREIGN KEY (ID_Pedido) 
        REFERENCES Pedido(ID_Pedido) ON DELETE CASCADE,
    CONSTRAINT FK_Linea_Producto FOREIGN KEY (ID_Producto) 
        REFERENCES Producto(ID_Producto) ON DELETE RESTRICT
);
