const Ziggy = {
    url: "http:\/\/localhost",
    port: null,
    defaults: {},
    routes: {
        "api.login": { uri: "api\/auth", methods: ["POST"] },
        "api.me": { uri: "api\/auth\/me", methods: ["GET", "HEAD"] },
        login: { uri: "auth", methods: ["GET", "HEAD"] },
        "login.store": { uri: "auth", methods: ["POST"] },
        "availability.index": { uri: "availability", methods: ["GET", "HEAD"] },
        index: { uri: "api\/users", methods: ["POST"] },
        user: { uri: "users", methods: ["GET", "HEAD"] },
        "user.store": { uri: "users", methods: ["POST"] },
        "sanctum.csrf-cookie": {
            uri: "sanctum\/csrf-cookie",
            methods: ["GET", "HEAD"],
        },
        "storage.local": {
            uri: "storage\/{path}",
            methods: ["GET", "HEAD"],
            wheres: { path: ".*" },
            parameters: ["path"],
        },
        "scramble.docs.ui": { uri: "docs\/api", methods: ["GET", "HEAD"] },
        "scramble.docs.document": {
            uri: "docs\/api.json",
            methods: ["GET", "HEAD"],
        },
    },
};
if (typeof window !== "undefined" && typeof window.Ziggy !== "undefined") {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
