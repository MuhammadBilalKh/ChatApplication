const express = require("express");
const http = require("http");
const { Server } = require("socket.io");

app.use(express.json());

const app = express();
const server = http.createServer(app);

const io = new Server(server, {
    cors: {
        origin: "*",
        methods: ["GET", "POST"]
    }
});

let onlineUsers = {};

io.on("connection", (socket) => {

    socket.on("join", (userId) => {
        onlineUsers[userId] = socket.id;
        console.log("User Joined:", userId);
    });

    socket.on("send-message", (data) => {
        let receiverSocket = onlineUsers[data.receiver_id];

        if (receiverSocket) {
            io.to(receiverSocket).emit("receive-message", data);
        }
    });

    socket.on("disconnect", () => {
        for (let uid in onlineUsers) {
            if (onlineUsers[uid] === socket.id) {
                delete onlineUsers[uid];
                break;
            }
        }
    });
});

app.post("/send", (req, res) => {
    let data = req.body;

    let receiverSocket = onlineUsers[data.receiver_id];

    if (receiverSocket) {
        io.to(receiverSocket).emit("receive-message", data);
    }

    res.json({ status: "sent" });
});

server.listen(3002, () => {
    console.log("Socket.IO Server Running on port 3002");
});
