(() => {
    (() => {
        var d = Object.defineProperty,
            m = (t) => d(t, "__esModule", { value: !0 }),
            f = (t, e) => {
                m(t);
                for (var i in e) d(t, i, { get: e[i], enumerable: !0 });
            },
            o = {};
        f(o, {
            eager: () => g,
            event: () => w,
            idle: () => y,
            media: () => b,
            visible: () => E,
        });
        var c = () => !0,
            g = c,
            v = ({ component: t, argument: e }) =>
                new Promise((i) => {
                    if (e) window.addEventListener(e, () => i(), { once: !0 });
                    else {
                        let n = (a) => {
                            a.detail.id === t.id &&
                                (window.removeEventListener(
                                    "async-alpine:load",
                                    n,
                                ),
                                i());
                        };
                        window.addEventListener("async-alpine:load", n);
                    }
                }),
            w = v,
            x = () =>
                new Promise((t) => {
                    "requestIdleCallback" in window
                        ? window.requestIdleCallback(t)
                        : setTimeout(t, 200);
                }),
            y = x,
            A = ({ argument: t }) =>
                new Promise((e) => {
                    if (!t)
                        return (
                            console.log(
                                "Async Alpine: media strategy requires a media query. Treating as 'eager'",
                            ),
                            e()
                        );
                    let i = window.matchMedia(`(${t})`);
                    i.matches
                        ? e()
                        : i.addEventListener("change", e, { once: !0 });
                }),
            b = A,
            $ = ({ component: t, argument: e }) =>
                new Promise((i) => {
                    let n = e || "0px 0px 0px 0px",
                        a = new IntersectionObserver(
                            (r) => {
                                r[0].isIntersecting && (a.disconnect(), i());
                            },
                            { rootMargin: n },
                        );
                    a.observe(t.el);
                }),
            E = $;
        function P(t) {
            let e = q(t),
                i = u(e);
            return i.type === "method"
                ? { type: "expression", operator: "&&", parameters: [i] }
                : i;
        }
        function q(t) {
            let e =
                    /\s*([()])\s*|\s*(\|\||&&|\|)\s*|\s*((?:[^()&|]+\([^()]+\))|[^()&|]+)\s*/g,
                i = [],
                n;
            for (; (n = e.exec(t)) !== null; ) {
                let [, a, r, s] = n;
                if (a !== void 0) i.push({ type: "parenthesis", value: a });
                else if (r !== void 0)
                    i.push({ type: "operator", value: r === "|" ? "&&" : r });
                else {
                    let p = { type: "method", method: s.trim() };
                    (s.includes("(") &&
                        ((p.method = s.substring(0, s.indexOf("(")).trim()),
                        (p.argument = s.substring(
                            s.indexOf("(") + 1,
                            s.indexOf(")"),
                        ))),
                        s.method === "immediate" && (s.method = "eager"),
                        i.push(p));
                }
            }
            return i;
        }
        function u(t) {
            let e = h(t);
            for (
                ;
                t.length > 0 &&
                (t[0].value === "&&" ||
                    t[0].value === "|" ||
                    t[0].value === "||");

            ) {
                let i = t.shift().value,
                    n = h(t);
                e.type === "expression" && e.operator === i
                    ? e.parameters.push(n)
                    : (e = {
                          type: "expression",
                          operator: i,
                          parameters: [e, n],
                      });
            }
            return e;
        }
        function h(t) {
            if (t[0].value === "(") {
                t.shift();
                let e = u(t);
                return (t[0].value === ")" && t.shift(), e);
            } else return t.shift();
        }
        var _ = "__internal_",
            l = {
                Alpine: null,
                _options: {
                    prefix: "ax-",
                    alpinePrefix: "x-",
                    root: "load",
                    inline: "load-src",
                    defaultStrategy: "eager",
                },
                _alias: !1,
                _data: {},
                _realIndex: 0,
                get _index() {
                    return this._realIndex++;
                },
                init(t, e = {}) {
                    return (
                        (this.Alpine = t),
                        (this._options = { ...this._options, ...e }),
                        this
                    );
                },
                start() {
                    return (
                        this._processInline(),
                        this._setupComponents(),
                        this._mutations(),
                        this
                    );
                },
                data(t, e = !1) {
                    return (
                        (this._data[t] = { loaded: !1, download: e }),
                        this
                    );
                },
                url(t, e) {
                    !t ||
                        !e ||
                        (this._data[t] || this.data(t),
                        (this._data[t].download = () =>
                            import(this._parseUrl(e))));
                },
                alias(t) {
                    this._alias = t;
                },
                _processInline() {
                    let t = document.querySelectorAll(
                        `[${this._options.prefix}${this._options.inline}]`,
                    );
                    for (let e of t) this._inlineElement(e);
                },
                _inlineElement(t) {
                    let e = t.getAttribute(`${this._options.alpinePrefix}data`),
                        i = t.getAttribute(
                            `${this._options.prefix}${this._options.inline}`,
                        );
                    if (!e || !i) return;
                    let n = this._parseName(e);
                    this.url(n, i);
                },
                _setupComponents() {
                    let t = document.querySelectorAll(
                        `[${this._options.prefix}${this._options.root}]`,
                    );
                    for (let e of t) this._setupComponent(e);
                },
                _setupComponent(t) {
                    let e = t.getAttribute(`${this._options.alpinePrefix}data`);
                    t.setAttribute(`${this._options.alpinePrefix}ignore`, "");
                    let i = this._parseName(e),
                        n =
                            t.getAttribute(
                                `${this._options.prefix}${this._options.root}`,
                            ) || this._options.defaultStrategy;
                    this._componentStrategy({
                        name: i,
                        strategy: n,
                        el: t,
                        id: t.id || this._index,
                    });
                },
                async _componentStrategy(t) {
                    let e = P(t.strategy);
                    (await this._generateRequirements(t, e),
                        await this._download(t.name),
                        this._activate(t));
                },
                _generateRequirements(t, e) {
                    if (e.type === "expression") {
                        if (e.operator === "&&")
                            return Promise.all(
                                e.parameters.map((i) =>
                                    this._generateRequirements(t, i),
                                ),
                            );
                        if (e.operator === "||")
                            return Promise.any(
                                e.parameters.map((i) =>
                                    this._generateRequirements(t, i),
                                ),
                            );
                    }
                    return o[e.method]
                        ? o[e.method]({ component: t, argument: e.argument })
                        : !1;
                },
                async _download(t) {
                    if (
                        t.startsWith(_) ||
                        (this._handleAlias(t),
                        !this._data[t] || this._data[t].loaded)
                    )
                        return;
                    let e = await this._getModule(t);
                    (this.Alpine.data(t, e), (this._data[t].loaded = !0));
                },
                async _getModule(t) {
                    if (!this._data[t]) return;
                    let e = await this._data[t].download(t);
                    return typeof e == "function"
                        ? e
                        : e[t] || e.default || Object.values(e)[0] || !1;
                },
                _activate(t) {
                    (this.Alpine.destroyTree(t.el),
                        t.el.removeAttribute(
                            `${this._options.alpinePrefix}ignore`,
                        ),
                        (t.el._x_ignore = !1),
                        this.Alpine.initTree(t.el));
                },
                _mutations() {
                    new MutationObserver((t) => {
                        for (let e of t)
                            if (e.addedNodes)
                                for (let i of e.addedNodes)
                                    i.nodeType === 1 &&
                                        (i.hasAttribute(
                                            `${this._options.prefix}${this._options.root}`,
                                        ) && this._mutationEl(i),
                                        i
                                            .querySelectorAll(
                                                `[${this._options.prefix}${this._options.root}]`,
                                            )
                                            .forEach((n) =>
                                                this._mutationEl(n),
                                            ));
                    }).observe(document, {
                        attributes: !0,
                        childList: !0,
                        subtree: !0,
                    });
                },
                _mutationEl(t) {
                    (t.hasAttribute(
                        `${this._options.prefix}${this._options.inline}`,
                    ) && this._inlineElement(t),
                        this._setupComponent(t));
                },
                _handleAlias(t) {
                    if (!(!this._alias || this._data[t])) {
                        if (typeof this._alias == "function") {
                            this.data(t, this._alias);
                            return;
                        }
                        this.url(t, this._alias.replaceAll("[name]", t));
                    }
                },
                _parseName(t) {
                    return (t || "").split(/[({]/g)[0] || `${_}${this._index}`;
                },
                _parseUrl(t) {
                    return new RegExp("^(?:[a-z+]+:)?//", "i").test(t)
                        ? t
                        : new URL(t, document.baseURI).href;
                },
            };
        document.addEventListener("alpine:init", () => {
            ((window.AsyncAlpine = l),
                l.init(Alpine, window.AsyncAlpineOptions || {}),
                document.dispatchEvent(new CustomEvent("async-alpine:init")),
                l.start());
        });
    })();
})();
