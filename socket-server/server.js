const express = require("express");
const http = require("http");
const socketIo = require("socket.io");
const { Pool, Client } = require("pg");
const cors = require("cors");

const app = express();
const server = http.createServer(app);
const io = socketIo(server, {
    cors: {
        origin: "*",
    },
});

const pool = new Pool({
    user: "yasir",
    host: "localhost",
    database: "dbemspg",
    password: "yasir",
    port: 5432,
});

// Koneksi khusus untuk mendengarkan event dari PostgreSQL
const client = new Client({
    user: "yasir",
    host: "localhost",
    database: "dbemspg",
    password: "yasir",
    port: 5432,
});
client.connect();

// Mendengarkan event NOTIFY dari PostgreSQL
client.query("LISTEN sensor_update");

client.on("notification", async (msg) => {
    console.log("Database updated:", msg.payload);
    const data = JSON.parse(msg.payload);
    io.emit("update_data", data);
});

io.on("connection", async (socket) => {
    console.log("Client connected");
});

server.listen(3001, () => {
    console.log("Socket.IO server running on port 3001");
});
