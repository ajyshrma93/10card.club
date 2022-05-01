var __defProp = Object.defineProperty,
    __hasOwnProp = Object.prototype.hasOwnProperty,
    __getOwnPropSymbols = Object.getOwnPropertySymbols,
    __propIsEnum = Object.prototype.propertyIsEnumerable,
    __defNormalProp = (e, s, t) =>
        s in e
            ? __defProp(e, s, {
                  enumerable: !0,
                  configurable: !0,
                  writable: !0,
                  value: t,
              })
            : (e[s] = t),
    __assign = (e, s) => {
        for (var t in s || (s = {}))
            __hasOwnProp.call(s, t) && __defNormalProp(e, t, s[t]);
        if (__getOwnPropSymbols)
            for (var t of __getOwnPropSymbols(s))
                __propIsEnum.call(s, t) && __defNormalProp(e, t, s[t]);
        return e;
    };
!(function (e, s) {
    "object" == typeof exports && "undefined" != typeof module
        ? s(exports, require("axios"))
        : "function" == typeof define && define.amd
        ? define(["exports", "axios"], s)
        : s(
              ((e =
                  "undefined" != typeof globalThis
                      ? globalThis
                      : e || self).Form = {}),
              e.axios
          );
})(this, function (e, s) {
    "use strict";
    function t(e) {
        return e && "object" == typeof e && "default" in e ? e : { default: e };
    }
    var r = t(s);
    const o = (e) => void 0 === e,
        i = (e) => Array.isArray(e),
        n = (e) =>
            e &&
            "number" == typeof e.size &&
            "string" == typeof e.type &&
            "function" == typeof e.slice,
        a = (e, s, t, r) => (
            ((s = s || {}).indices = !o(s.indices) && s.indices),
            (s.nullsAsUndefineds =
                !o(s.nullsAsUndefineds) && s.nullsAsUndefineds),
            (s.booleansAsIntegers =
                !o(s.booleansAsIntegers) && s.booleansAsIntegers),
            (s.allowEmptyArrays = !o(s.allowEmptyArrays) && s.allowEmptyArrays),
            (t = t || new FormData()),
            o(e) ||
                (null === e
                    ? s.nullsAsUndefineds || t.append(r, "")
                    : ((e) => "boolean" == typeof e)(e)
                    ? s.booleansAsIntegers
                        ? t.append(r, e ? 1 : 0)
                        : t.append(r, e)
                    : i(e)
                    ? e.length
                        ? e.forEach((e, o) => {
                              const i = r + "[" + (s.indices ? o : "") + "]";
                              a(e, s, t, i);
                          })
                        : s.allowEmptyArrays && t.append(r + "[]", "")
                    : ((e) => e instanceof Date)(e)
                    ? t.append(r, e.toISOString())
                    : !((e) => e === Object(e))(e) ||
                      ((e) =>
                          n(e) &&
                          "string" == typeof e.name &&
                          ("object" == typeof e.lastModifiedDate ||
                              "number" == typeof e.lastModified))(e) ||
                      n(e)
                    ? t.append(r, e)
                    : Object.keys(e).forEach((o) => {
                          const n = e[o];
                          if (i(n))
                              for (
                                  ;
                                  o.length > 2 &&
                                  o.lastIndexOf("[]") === o.length - 2;

                              )
                                  o = o.substring(0, o.length - 2);
                          a(n, s, t, r ? r + "[" + o + "]" : o);
                      })),
            t
        );
    var l = { serialize: a };
    function c(e) {
        if (null === e || "object" != typeof e) return e;
        const s = Array.isArray(e) ? [] : {};
        return (
            Object.keys(e).forEach((t) => {
                s[t] = c(e[t]);
            }),
            s
        );
    }
    function u(e) {
        return Array.isArray(e) ? e : [e];
    }
    function h(e) {
        return (
            e instanceof File ||
            e instanceof Blob ||
            e instanceof FileList ||
            ("object" == typeof e &&
                null !== e &&
                void 0 !== Object.values(e).find((e) => h(e)))
        );
    }
    class d {
        constructor() {
            (this.errors = {}), (this.errors = {});
        }
        set(e, s) {
            "object" == typeof e
                ? (this.errors = e)
                : this.set(__assign(__assign({}, this.errors), { [e]: u(s) }));
        }
        all() {
            return this.errors;
        }
        has(e) {
            return Object.prototype.hasOwnProperty.call(this.errors, e);
        }
        hasAny(...e) {
            return e.some((e) => this.has(e));
        }
        any() {
            return Object.keys(this.errors).length > 0;
        }
        get(e) {
            if (this.has(e)) return this.getAll(e)[0];
        }
        getAll(e) {
            return u(this.errors[e] || []);
        }
        only(...e) {
            const s = [];
            return (
                e.forEach((e) => {
                    const t = this.get(e);
                    t && s.push(t);
                }),
                s
            );
        }
        flatten() {
            return Object.values(this.errors).reduce((e, s) => e.concat(s), []);
        }
        clear(e) {
            const s = {};
            e &&
                Object.keys(this.errors).forEach((t) => {
                    t !== e && (s[t] = this.errors[t]);
                }),
                this.set(s);
        }
    }
    class f {
        constructor(e = {}) {
            (this.originalData = {}),
                (this.busy = !1),
                (this.successful = !1),
                (this.recentlySuccessful = !1),
                (this.recentlySuccessfulTimeoutId = void 0),
                (this.errors = new d()),
                (this.progress = void 0),
                this.update(e);
        }
        static make(e) {
            return new this(e);
        }
        update(e) {
            (this.originalData = Object.assign({}, this.originalData, c(e))),
                Object.assign(this, e);
        }
        fill(e = {}) {
            this.keys().forEach((s) => {
                this[s] = e[s];
            });
        }
        data() {
            return this.keys().reduce(
                (e, s) => __assign(__assign({}, e), { [s]: this[s] }),
                {}
            );
        }
        keys() {
            return Object.keys(this).filter((e) => !f.ignore.includes(e));
        }
        startProcessing() {
            this.errors.clear(),
                (this.busy = !0),
                (this.successful = !1),
                (this.progress = void 0),
                (this.recentlySuccessful = !1),
                clearTimeout(this.recentlySuccessfulTimeoutId);
        }
        finishProcessing() {
            (this.busy = !1),
                (this.successful = !0),
                (this.progress = void 0),
                (this.recentlySuccessful = !0),
                (this.recentlySuccessfulTimeoutId = setTimeout(() => {
                    this.recentlySuccessful = !1;
                }, f.recentlySuccessfulTimeout));
        }
        clear() {
            this.errors.clear(),
                (this.successful = !1),
                (this.recentlySuccessful = !1),
                (this.progress = void 0),
                clearTimeout(this.recentlySuccessfulTimeoutId);
        }
        reset() {
            Object.keys(this)
                .filter((e) => !f.ignore.includes(e))
                .forEach((e) => {
                    this[e] = c(this.originalData[e]);
                });
        }
        get(e, s = {}) {
            return this.submit("get", e, s);
        }
        post(e, s = {}) {
            return this.submit("post", e, s);
        }
        patch(e, s = {}) {
            return this.submit("patch", e, s);
        }
        put(e, s = {}) {
            return this.submit("put", e, s);
        }
        delete(e, s = {}) {
            return this.submit("delete", e, s);
        }
        submit(e, s, t = {}) {
            return (
                this.startProcessing(),
                (t = __assign(
                    {
                        data: {},
                        params: {},
                        url: this.route(s),
                        method: e,
                        onUploadProgress: this.handleUploadProgress.bind(this),
                    },
                    t
                )),
                "get" === e.toLowerCase()
                    ? (t.params = __assign(__assign({}, this.data()), t.params))
                    : ((t.data = __assign(__assign({}, this.data()), t.data)),
                      h(t.data) &&
                          !t.transformRequest &&
                          (t.transformRequest = [(e) => l.serialize(e)])),
                new Promise((e, s) => {
                    (f.axios || r.default)
                        .request(t)
                        .then((s) => {
                            this.finishProcessing(), e(s);
                        })
                        .catch((e) => {
                            this.handleErrors(e), s(e);
                        });
                })
            );
        }
        handleErrors(e) {
            (this.busy = !1),
                (this.progress = void 0),
                e.response && this.errors.set(this.extractErrors(e.response));
        }
        extractErrors(e) {
            return e.data && "object" == typeof e.data
                ? e.data.errors
                    ? __assign({}, e.data.errors)
                    : e.data.message
                    ? { error: e.data.message }
                    : __assign({}, e.data)
                : { error: f.errorMessage };
        }
        handleUploadProgress(e) {
            this.progress = {
                total: e.total,
                loaded: e.loaded,
                percentage: Math.round((100 * e.loaded) / e.total),
            };
        }
        route(e, s = {}) {
            let t = e;
            return (
                Object.prototype.hasOwnProperty.call(f.routes, e) &&
                    (t = decodeURI(f.routes[e])),
                "object" != typeof s && (s = { id: s }),
                Object.keys(s).forEach((e) => {
                    t = t.replace(`{${e}}`, s[e]);
                }),
                t
            );
        }
        onKeydown(e) {
            const s = e.target;
            s.name && this.errors.clear(s.name);
        }
        onChange(e) {
            const s = e.target;
            s.name && this.errors.clear(s.name);
        }
    }
    (f.routes = {}),
        (f.errorMessage = "Something went wrong. Please try again."),
        (f.recentlySuccessfulTimeout = 2e3),
        (f.ignore = [
            "busy",
            "successful",
            "errors",
            "progress",
            "originalData",
            "recentlySuccessful",
            "recentlySuccessfulTimeoutId",
        ]),
        (e.Errors = d),
        (e.Form = f),
        (e.default = f),
        Object.defineProperty(e, "__esModule", { value: !0 }),
        (e[Symbol.toStringTag] = "Module");
});
