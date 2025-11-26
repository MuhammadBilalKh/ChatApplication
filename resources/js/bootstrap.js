import Echo from "laravel-echo";

window.Echo = new Echo({
    broadcaster: "pusher",
    key: "c13b814e8642a696550b",
    cluster: "ap2",
    forceTLS: true,
});
