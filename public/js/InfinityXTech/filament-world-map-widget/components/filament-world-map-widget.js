var Q = function (s) {
    return ee(s) && !te(s);
};
function ee(t) {
    return !!t && typeof t == "object";
}
function te(t) {
    var s = Object.prototype.toString.call(t);
    return s === "[object RegExp]" || s === "[object Date]" || re(t) || ae(t);
}
var ie = typeof Symbol == "function" && Symbol.for,
    se = ie ? Symbol.for("react.element") : 60103;
function ae(t) {
    return t.$$typeof === se;
}
function re(t) {
    return t instanceof Node;
}
function ne(t) {
    return Array.isArray(t) ? [] : {};
}
function T(t, s) {
    return s.clone !== !1 && s.isMergeableObject(t) ? C(ne(t), t, s) : t;
}
function oe(t, s, a) {
    return t.concat(s).map(function (e) {
        return T(e, a);
    });
}
function le(t, s) {
    if (!s.customMerge) return C;
    var a = s.customMerge(t);
    return typeof a == "function" ? a : C;
}
function he(t) {
    return Object.getOwnPropertySymbols
        ? Object.getOwnPropertySymbols(t).filter(function (s) {
              return t.propertyIsEnumerable(s);
          })
        : [];
}
function V(t) {
    return Object.keys(t).concat(he(t));
}
function G(t, s) {
    try {
        return s in t;
    } catch {
        return !1;
    }
}
function ce(t, s) {
    return (
        G(t, s) &&
        !(
            Object.hasOwnProperty.call(t, s) &&
            Object.propertyIsEnumerable.call(t, s)
        )
    );
}
function ue(t, s, a) {
    var e = {};
    return (
        a.isMergeableObject(t) &&
            V(t).forEach(function (i) {
                e[i] = T(t[i], a);
            }),
        V(s).forEach(function (i) {
            ce(t, i) ||
                (G(t, i) && a.isMergeableObject(s[i])
                    ? (e[i] = le(i, a)(t[i], s[i], a))
                    : (e[i] = T(s[i], a)));
        }),
        e
    );
}
var C = function (s, a, e) {
        ((e = e || {}),
            (e.arrayMerge = e.arrayMerge || oe),
            (e.isMergeableObject = e.isMergeableObject || Q),
            (e.cloneUnlessOtherwiseSpecified = T));
        var i = Array.isArray(a),
            r = Array.isArray(s),
            n = i === r;
        return n ? (i ? e.arrayMerge(s, a, e) : ue(s, a, e)) : T(a, e);
    },
    W = function (s) {
        return typeof s == "object" && typeof s.nodeType < "u"
            ? s
            : typeof s == "string"
              ? document.querySelector(s)
              : null;
    },
    y = function (s, a, e, i) {
        i === void 0 && (i = !1);
        var r = document.createElement(s);
        return (
            e && (r[i ? "innerHTML" : "textContent"] = e),
            a && (r.className = a),
            r
        );
    },
    fe = function (s, a) {
        return Element.prototype.querySelector.call(s, a);
    },
    Y = function (s) {
        s.parentNode.removeChild(s);
    },
    pe = function (s) {
        return /\.(jpg|gif|png)$/.test(s);
    },
    de = function (s) {
        return s
            .replace(/[\w]([A-Z])/g, function (a) {
                return a[0] + "-" + a[1];
            })
            .toLowerCase();
    },
    v = function (s, a, e) {
        return (e === void 0 && (e = !1), e ? C(s, a) : Object.assign(s, a));
    },
    A = function (s, a) {
        return s.toLowerCase() + ":to:" + a.toLowerCase();
    },
    F = function (s, a) {
        Object.assign(s.prototype, a);
    },
    k = {},
    me = 1,
    d = {
        on: function (s, a, e, i) {
            i === void 0 && (i = {});
            var r = "jvm:" + a + "::" + me++;
            ((k[r] = { selector: s, handler: e }),
                (e._uid = r),
                s.addEventListener(a, e, i));
        },
        delegate: function (s, a, e, i) {
            ((a = a.split(" ")),
                a.forEach(function (r) {
                    d.on(s, r, function (n) {
                        var o = n.target;
                        o.matches(e) && i.call(o, n);
                    });
                }));
        },
        off: function (s, a, e) {
            var i = a.split(":")[1];
            (s.removeEventListener(i, e), delete k[e._uid]);
        },
        flush: function () {
            Object.keys(k).forEach(function (s) {
                d.off(k[s].selector, s, k[s].handler);
            });
        },
        getEventRegistry: function () {
            return k;
        },
    };
function ge() {
    var t = this,
        s = this,
        a = !1,
        e,
        i;
    (this.params.draggable &&
        (d.on(this.container, "mousemove", function (r) {
            if (!a) return !1;
            ((s.transX -= (e - r.pageX) / s.scale),
                (s.transY -= (i - r.pageY) / s.scale),
                s._applyTransform(),
                (e = r.pageX),
                (i = r.pageY));
        }),
        d.on(this.container, "mousedown", function (r) {
            return ((a = !0), (e = r.pageX), (i = r.pageY), !1);
        }),
        d.on(document.body, "mouseup", function () {
            a = !1;
        })),
        this.params.zoomOnScroll &&
            d.on(this.container, "wheel", function (r) {
                var n =
                        ((r.deltaY || -r.wheelDelta || r.detail) >> 10 || 1) *
                        75,
                    o = t.container.getBoundingClientRect(),
                    l = r.pageX - o.left - window.pageXOffset,
                    u = r.pageY - o.top - window.pageYOffset,
                    c = Math.pow(
                        1 + s.params.zoomOnScrollSpeed / 1e3,
                        -1.5 * n,
                    );
                (s.tooltip && s._tooltip.hide(),
                    s._setScale(s.scale * c, l, u),
                    r.preventDefault());
            }));
}
var _ = {
        onLoaded: "map:loaded",
        onViewportChange: "viewport:changed",
        onRegionClick: "region:clicked",
        onMarkerClick: "marker:clicked",
        onRegionSelected: "region:selected",
        onMarkerSelected: "marker:selected",
        onRegionTooltipShow: "region.tooltip:show",
        onMarkerTooltipShow: "marker.tooltip:show",
        onDestroyed: "map:destroyed",
    },
    P = function (s, a, e) {
        var i = W(a),
            r =
                i.getAttribute("class").indexOf("jvm-region") === -1
                    ? "marker"
                    : "region",
            n = r === "region",
            o = n ? i.getAttribute("data-code") : i.getAttribute("data-index"),
            l = n ? _.onRegionSelected : _.onMarkerSelected;
        return (
            e && (l = n ? _.onRegionTooltipShow : _.onMarkerTooltipShow),
            {
                type: r,
                code: o,
                event: l,
                element: n ? s.regions[o].element : s._markers[o].element,
                tooltipText: n
                    ? s._mapData.paths[o].name || ""
                    : s._markers[o].config.name || "",
            }
        );
    };
function ve() {
    var t = this,
        s = this.container,
        a,
        e,
        i;
    (d.on(s, "mousemove", function (r) {
        Math.abs(a - r.pageX) + Math.abs(e - r.pageY) > 2 && (i = !0);
    }),
        d.delegate(s, "mousedown", ".jvm-element", function (r) {
            ((a = r.pageX), (e = r.pageY), (i = !1));
        }),
        d.delegate(s, "mouseover mouseout", ".jvm-element", function (r) {
            var n = P(t, this, !0),
                o = t.params.showTooltip;
            r.type === "mouseover"
                ? (n.element.hover(!0),
                  o &&
                      (t._tooltip.text(n.tooltipText),
                      t._tooltip.show(),
                      t._emit(n.event, [r, t._tooltip, n.code])))
                : (n.element.hover(!1), o && t._tooltip.hide());
        }),
        d.delegate(s, "mouseup", ".jvm-element", function (r) {
            var n = P(t, this);
            if (
                !i &&
                ((n.type === "region" && t.params.regionsSelectable) ||
                    (n.type === "marker" && t.params.markersSelectable))
            ) {
                var o = n.element;
                (t.params[n.type + "sSelectableOne"] &&
                    t._clearSelected(n.type + "s"),
                    n.element.isSelected ? o.select(!1) : o.select(!0),
                    t._emit(n.event, [
                        n.code,
                        o.isSelected,
                        t._getSelected(n.type + "s"),
                    ]));
            }
        }),
        d.delegate(s, "click", ".jvm-element", function (r) {
            var n = P(t, this),
                o = n.type,
                l = n.code;
            t._emit(o === "region" ? _.onRegionClick : _.onMarkerClick, [r, l]);
        }));
}
function _e() {
    var t = this,
        s = y("div", "jvm-zoom-btn jvm-zoomin", "&#43;", !0),
        a = y("div", "jvm-zoom-btn jvm-zoomout", "&#x2212", !0);
    (this.container.appendChild(s), this.container.appendChild(a));
    var e = function (r) {
        return (
            r === void 0 && (r = !0),
            function () {
                return t._setScale(
                    r
                        ? t.scale * t.params.zoomStep
                        : t.scale / t.params.zoomStep,
                    t._width / 2,
                    t._height / 2,
                    !1,
                    t.params.zoomAnimate,
                );
            }
        );
    };
    (d.on(s, "click", e()), d.on(a, "click", e(!1)));
}
function ye() {
    var t = this,
        s,
        a,
        e,
        i,
        r,
        n,
        o,
        l = function (c) {
            var h = c.touches,
                f,
                p,
                m,
                S;
            if ((c.type == "touchstart" && (o = 0), h.length == 1))
                (o == 1 &&
                    ((m = t.transX),
                    (S = t.transY),
                    (t.transX -= (e - h[0].pageX) / t.scale),
                    (t.transY -= (i - h[0].pageY) / t.scale),
                    t._tooltip.hide(),
                    t._applyTransform(),
                    (m != t.transX || S != t.transY) && c.preventDefault()),
                    (e = h[0].pageX),
                    (i = h[0].pageY));
            else if (h.length == 2)
                if (o == 2)
                    ((p =
                        Math.sqrt(
                            Math.pow(h[0].pageX - h[1].pageX, 2) +
                                Math.pow(h[0].pageY - h[1].pageY, 2),
                        ) / a),
                        t._setScale(s * p, r, n),
                        t._tooltip.hide(),
                        c.preventDefault());
                else {
                    var b = t.container.getBoundingClientRect();
                    ((f = {
                        top: b.top + window.scrollY,
                        left: b.left + window.scrollX,
                    }),
                        h[0].pageX > h[1].pageX
                            ? (r = h[1].pageX + (h[0].pageX - h[1].pageX) / 2)
                            : (r = h[0].pageX + (h[1].pageX - h[0].pageX) / 2),
                        h[0].pageY > h[1].pageY
                            ? (n = h[1].pageY + (h[0].pageY - h[1].pageY) / 2)
                            : (n = h[0].pageY + (h[1].pageY - h[0].pageY) / 2),
                        (r -= f.left),
                        (n -= f.top),
                        (s = t.scale),
                        (a = Math.sqrt(
                            Math.pow(h[0].pageX - h[1].pageX, 2) +
                                Math.pow(h[0].pageY - h[1].pageY, 2),
                        )));
                }
            o = h.length;
        };
    (d.on(t.container, "touchstart", l), d.on(t.container, "touchmove", l));
}
function H(t, s) {
    (s == null || s > t.length) && (s = t.length);
    for (var a = 0, e = Array(s); a < s; a++) e[a] = t[a];
    return e;
}
function be(t) {
    if (t === void 0)
        throw new ReferenceError(
            "this hasn't been initialised - super() hasn't been called",
        );
    return t;
}
function Se(t, s) {
    var a = (typeof Symbol < "u" && t[Symbol.iterator]) || t["@@iterator"];
    if (a) return (a = a.call(t)).next.bind(a);
    if (
        Array.isArray(t) ||
        (a = Me(t)) ||
        (s && t && typeof t.length == "number")
    ) {
        a && (t = a);
        var e = 0;
        return function () {
            return e >= t.length ? { done: !0 } : { done: !1, value: t[e++] };
        };
    }
    throw new TypeError(`Invalid attempt to iterate non-iterable instance.
In order to be iterable, non-array objects must have a [Symbol.iterator]() method.`);
}
function R() {
    return (
        (R = Object.assign
            ? Object.assign.bind()
            : function (t) {
                  for (var s = 1; s < arguments.length; s++) {
                      var a = arguments[s];
                      for (var e in a)
                          ({}).hasOwnProperty.call(a, e) && (t[e] = a[e]);
                  }
                  return t;
              }),
        R.apply(null, arguments)
    );
}
function w(t, s) {
    ((t.prototype = Object.create(s.prototype)),
        (t.prototype.constructor = t),
        I(t, s));
}
function I(t, s) {
    return (
        (I = Object.setPrototypeOf
            ? Object.setPrototypeOf.bind()
            : function (a, e) {
                  return ((a.__proto__ = e), a);
              }),
        I(t, s)
    );
}
function Me(t, s) {
    if (t) {
        if (typeof t == "string") return H(t, s);
        var a = {}.toString.call(t).slice(8, -1);
        return (
            a === "Object" && t.constructor && (a = t.constructor.name),
            a === "Map" || a === "Set"
                ? Array.from(t)
                : a === "Arguments" ||
                    /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(a)
                  ? H(t, s)
                  : void 0
        );
    }
}
var X = (function () {
        function t() {}
        var s = t.prototype;
        return (
            (s.dispose = function () {
                this._tooltip ? Y(this._tooltip) : this.shape.remove();
                for (
                    var e = Se(Object.getOwnPropertyNames(this)), i;
                    !(i = e()).done;

                ) {
                    var r = i.value;
                    this[r] = null;
                }
            }),
            t
        );
    })(),
    $ = {
        getLabelText: function (s, a) {
            if (a) {
                if (typeof a.render == "function") {
                    var e = [];
                    return (
                        this.config &&
                            this.config.marker &&
                            e.push(this.config.marker),
                        e.push(s),
                        a.render.apply(this, e)
                    );
                }
                return s;
            }
        },
        getLabelOffsets: function (s, a) {
            return typeof a.offsets == "function"
                ? a.offsets(s)
                : Array.isArray(a.offsets)
                  ? a.offsets[s]
                  : [0, 0];
        },
        setStyle: function (s, a) {
            this.shape.setStyle(s, a);
        },
        remove: function () {
            (this.shape.remove(), this.label && this.label.remove());
        },
        hover: function (s) {
            this._setStatus("isHovered", s);
        },
        select: function (s) {
            this._setStatus("isSelected", s);
        },
        _setStatus: function (s, a) {
            ((this.shape[s] = a),
                this.shape.updateStyle(),
                (this[s] = a),
                this.label && ((this.label[s] = a), this.label.updateStyle()));
        },
    },
    B = (function (t) {
        function s(e) {
            var i,
                r = e.map,
                n = e.code,
                o = e.path,
                l = e.style,
                u = e.label,
                c = e.labelStyle,
                h = e.labelsGroup;
            ((i = t.call(this) || this),
                (i._map = r),
                (i.shape = i._createRegion(o, n, l)));
            var f = i.getLabelText(n, u);
            if (u && f) {
                var p = i.shape.getBBox(),
                    m = i.getLabelOffsets(n, u);
                ((i.labelX = p.x + p.width / 2 + m[0]),
                    (i.labelY = p.y + p.height / 2 + m[1]),
                    (i.label = i._map.canvas.createText(
                        {
                            text: f,
                            textAnchor: "middle",
                            alignmentBaseline: "central",
                            dataCode: n,
                            x: i.labelX,
                            y: i.labelY,
                        },
                        c,
                        h,
                    )),
                    i.label.addClass("jvm-region jvm-element"));
            }
            return i;
        }
        w(s, t);
        var a = s.prototype;
        return (
            (a._createRegion = function (i, r, n) {
                return (
                    (i = this._map.canvas.createPath({ d: i, dataCode: r }, n)),
                    i.addClass("jvm-region jvm-element"),
                    i
                );
            }),
            (a.updateLabelPosition = function () {
                this.label &&
                    this.label.set({
                        x:
                            this.labelX * this._map.scale +
                            this._map.transX * this._map.scale,
                        y:
                            this.labelY * this._map.scale +
                            this._map.transY * this._map.scale,
                    });
            }),
            s
        );
    })(X);
F(B, $);
function we() {
    this._regionLabelsGroup =
        this._regionLabelsGroup ||
        this.canvas.createGroup("jvm-regions-labels-group");
    for (var t in this._mapData.paths) {
        var s = new B({
            map: this,
            code: t,
            path: this._mapData.paths[t].path,
            style: v({}, this.params.regionStyle),
            labelStyle: this.params.regionLabelStyle,
            labelsGroup: this._regionLabelsGroup,
            label: this.params.labels && this.params.labels.regions,
        });
        this.regions[t] = { config: this._mapData.paths[t], element: s };
    }
}
var xe = (function (t) {
    function s(e) {
        var i,
            r = e.index,
            n = e.map,
            o = e.style,
            l = e.x1,
            u = e.y1,
            c = e.x2,
            h = e.y2,
            f = e.group,
            p = e.config;
        return (
            (i = t.call(this) || this),
            (i.config = p),
            (i.shape = n.canvas.createLine(
                { x1: l, y1: u, x2: c, y2: h, dataIndex: r },
                o,
                f,
            )),
            i.shape.addClass("jvm-line"),
            i
        );
    }
    w(s, t);
    var a = s.prototype;
    return (
        (a.setStyle = function (i, r) {
            this.shape.setStyle(i, r);
        }),
        s
    );
})(X);
function ke(t, s, a) {
    a === void 0 && (a = !1);
    var e = !1,
        i = !1;
    this.linesGroup =
        this.linesGroup || this.canvas.createGroup("jvm-lines-group");
    for (var r in t) {
        var n = t[r];
        for (var o in s) {
            var l = a ? s[o].config : s[o];
            (l.name === n.from && (e = this.getMarkerPosition(l)),
                l.name === n.to && (i = this.getMarkerPosition(l)));
        }
        e !== !1 &&
            i !== !1 &&
            (this._lines[A(n.from, n.to)] = new xe({
                index: r,
                map: this,
                style: v(
                    { initial: this.params.lineStyle },
                    { initial: n.style || {} },
                    !0,
                ),
                x1: e.x,
                y1: e.y,
                x2: i.x,
                y2: i.y,
                group: this.linesGroup,
                config: n,
            }));
    }
}
var N = (function (t) {
    function s(e) {
        var i,
            r = e.index,
            n = e.style,
            o = e.label,
            l = e.cx,
            u = e.cy,
            c = e.map,
            h = e.group;
        return (
            (i = t.call(this) || this),
            (i._map = c),
            (i._isImage = !!n.initial.image),
            (i.config = arguments[0]),
            (i.shape = c.canvas[i._isImage ? "createImage" : "createCircle"](
                { dataIndex: r, cx: l, cy: u },
                n,
                h,
            )),
            i.shape.addClass("jvm-marker jvm-element"),
            i._isImage && i.updateLabelPosition(),
            o && i._createLabel(i.config),
            i
        );
    }
    w(s, t);
    var a = s.prototype;
    return (
        (a.updateLabelPosition = function () {
            this.label &&
                this.label.set({
                    x:
                        this._labelX * this._map.scale +
                        this._offsets[0] +
                        this._map.transX * this._map.scale +
                        5 +
                        (this._isImage
                            ? (this.shape.width || 0) / 2
                            : this.shape.node.r.baseVal.value),
                    y:
                        this._labelY * this._map.scale +
                        this._map.transY * this._map.scale +
                        this._offsets[1],
                });
        }),
        (a._createLabel = function (i) {
            var r = i.index,
                n = i.map,
                o = i.label,
                l = i.labelsGroup,
                u = i.cx,
                c = i.cy,
                h = i.marker,
                f = i.isRecentlyCreated,
                p = this.getLabelText(r, o);
            ((this._labelX = u / n.scale - n.transX),
                (this._labelY = c / n.scale - n.transY),
                (this._offsets =
                    f && h.offsets ? h.offsets : this.getLabelOffsets(r, o)),
                (this.label = n.canvas.createText(
                    {
                        text: p,
                        dataIndex: r,
                        x: this._labelX,
                        y: this._labelY,
                        dy: "0.6ex",
                    },
                    n.params.markerLabelStyle,
                    l,
                )),
                this.label.addClass("jvm-marker jvm-element"),
                f && this.updateLabelPosition());
        }),
        s
    );
})(X);
F(N, $);
function je(t, s) {
    var a = this;
    (t === void 0 && (t = {}),
        s === void 0 && (s = !1),
        (this._markersGroup =
            this._markersGroup || this.canvas.createGroup("jvm-markers-group")),
        (this._markerLabelsGroup =
            this._markerLabelsGroup ||
            this.canvas.createGroup("jvm-markers-labels-group")));
    var e = function () {
            var o = t[r],
                l = a.getMarkerPosition(o),
                u = o.coords.join(":");
            if (!l) return 0;
            if (s) {
                if (
                    Object.keys(a._markers).filter(function (h) {
                        return a._markers[h]._uid === u;
                    }).length
                )
                    return 0;
                r = Object.keys(a._markers).length;
            }
            var c = new N({
                index: r,
                map: a,
                style: v(a.params.markerStyle, R({}, o.style || {}), !0),
                label: a.params.labels && a.params.labels.markers,
                labelsGroup: a._markerLabelsGroup,
                cx: l.x,
                cy: l.y,
                group: a._markersGroup,
                marker: o,
                isRecentlyCreated: s,
            });
            (a._markers[r] && a.removeMarkers([r]),
                (a._markers[r] = { _uid: u, config: o, element: c }));
        },
        i;
    for (var r in t) i = e();
}
var Le = (function () {
        function t(a) {
            (a === void 0 && (a = {}),
                (this._options = a),
                (this._map = this._options.map),
                (this._series = this._options.series),
                (this._body = y("div", "jvm-legend")),
                this._options.cssClass &&
                    this._body.setAttribute("class", this._options.cssClass),
                a.vertical
                    ? this._map.legendVertical.appendChild(this._body)
                    : this._map.legendHorizontal.appendChild(this._body),
                this.render());
        }
        var s = t.prototype;
        return (
            (s.render = function () {
                var e = this._series.scale.getTicks(),
                    i = y("div", "jvm-legend-inner");
                if (((this._body.innderHTML = ""), this._options.title)) {
                    var r = y("div", "jvm-legend-title", this._options.title);
                    this._body.appendChild(r);
                }
                this._body.appendChild(i);
                for (var n = 0; n < e.length; n++) {
                    var o = y("div", "jvm-legend-tick"),
                        l = y("div", "jvm-legend-tick-sample");
                    switch (this._series.config.attribute) {
                        case "fill":
                            pe(e[n].value)
                                ? (l.style.background =
                                      "url(" + e[n].value + ")")
                                : (l.style.background = e[n].value);
                            break;
                        case "stroke":
                            l.style.background = e[n].value;
                            break;
                        case "image":
                            ((l.style.background =
                                "url(" +
                                (typeof e[n].value == "object"
                                    ? e[n].value.url
                                    : e[n].value) +
                                ") no-repeat center center"),
                                (l.style.backgroundSize = "cover"));
                            break;
                    }
                    o.appendChild(l);
                    var u = e[n].label;
                    this._options.labelRender &&
                        (u = this._options.labelRender(u));
                    var c = y("div", "jvm-legend-tick-text", u);
                    (o.appendChild(c), i.appendChild(o));
                }
            }),
            t
        );
    })(),
    Ee = (function () {
        function t(a) {
            this._scale = a;
        }
        var s = t.prototype;
        return (
            (s.getValue = function (e) {
                return this._scale[e];
            }),
            (s.getTicks = function () {
                var e = [];
                for (var i in this._scale)
                    e.push({ label: i, value: this._scale[i] });
                return e;
            }),
            t
        );
    })(),
    Te = (function () {
        function t(a, e, i) {
            (a === void 0 && (a = {}),
                (this._map = i),
                (this._elements = e),
                (this._values = a.values || {}),
                (this.config = a),
                (this.config.attribute = a.attribute || "fill"),
                a.attributes && this.setAttributes(a.attributes),
                typeof a.scale == "object" && (this.scale = new Ee(a.scale)),
                this.config.legend &&
                    (this.legend = new Le(
                        v({ map: this._map, series: this }, this.config.legend),
                    )),
                this.setValues(this._values));
        }
        var s = t.prototype;
        return (
            (s.setValues = function (e) {
                var i = {};
                for (var r in e) e[r] && (i[r] = this.scale.getValue(e[r]));
                this.setAttributes(i);
            }),
            (s.setAttributes = function (e) {
                for (var i in e)
                    this._elements[i] &&
                        this._elements[i].element.setStyle(
                            this.config.attribute,
                            e[i],
                        );
            }),
            (s.clear = function () {
                var e,
                    i = {};
                for (e in this._values)
                    this._elements[e] &&
                        (i[e] =
                            this._elements[e].element.shape.style.initial[
                                this.config.attribute
                            ]);
                (this.setAttributes(i), (this._values = {}));
            }),
            t
        );
    })();
function Oe() {
    this.series = { markers: [], regions: [] };
    for (var t in this.params.series)
        for (var s = 0; s < this.params.series[t].length; s++)
            this.series[t][s] = new Te(
                this.params.series[t][s],
                t === "markers" ? this._markers : this.regions,
                this,
            );
}
function Ae() {
    var t, s, a, e;
    (this._defaultWidth * this.scale <= this._width
        ? ((t =
              (this._width - this._defaultWidth * this.scale) /
              (2 * this.scale)),
          (a =
              (this._width - this._defaultWidth * this.scale) /
              (2 * this.scale)))
        : ((t = 0),
          (a = (this._width - this._defaultWidth * this.scale) / this.scale)),
        this._defaultHeight * this.scale <= this._height
            ? ((s =
                  (this._height - this._defaultHeight * this.scale) /
                  (2 * this.scale)),
              (e =
                  (this._height - this._defaultHeight * this.scale) /
                  (2 * this.scale)))
            : ((s = 0),
              (e =
                  (this._height - this._defaultHeight * this.scale) /
                  this.scale)),
        this.transY > s
            ? (this.transY = s)
            : this.transY < e && (this.transY = e),
        this.transX > t
            ? (this.transX = t)
            : this.transX < a && (this.transX = a),
        this.canvas.applyTransformParams(this.scale, this.transX, this.transY),
        this._markers && this._repositionMarkers(),
        this._lines && this._repositionLines(),
        this._repositionLabels());
}
function Ce() {
    var t = this._baseScale;
    (this._width / this._height > this._defaultWidth / this._defaultHeight
        ? ((this._baseScale = this._height / this._defaultHeight),
          (this._baseTransX =
              Math.abs(this._width - this._defaultWidth * this._baseScale) /
              (2 * this._baseScale)))
        : ((this._baseScale = this._width / this._defaultWidth),
          (this._baseTransY =
              Math.abs(this._height - this._defaultHeight * this._baseScale) /
              (2 * this._baseScale))),
        (this.scale *= this._baseScale / t),
        (this.transX *= this._baseScale / t),
        (this.transY *= this._baseScale / t));
}
function Ye(t, s, a, e, i) {
    var r = this,
        n,
        o,
        l = 0,
        u = Math.abs(
            Math.round(((t - this.scale) * 60) / Math.max(t, this.scale)),
        ),
        c,
        h,
        f,
        p,
        m,
        S,
        b,
        g;
    (t > this.params.zoomMax * this._baseScale
        ? (t = this.params.zoomMax * this._baseScale)
        : t < this.params.zoomMin * this._baseScale &&
          (t = this.params.zoomMin * this._baseScale),
        typeof s < "u" &&
            typeof a < "u" &&
            ((n = t / this.scale),
            e
                ? ((b =
                      s +
                      (this._defaultWidth *
                          (this._width / (this._defaultWidth * t))) /
                          2),
                  (g =
                      a +
                      (this._defaultHeight *
                          (this._height / (this._defaultHeight * t))) /
                          2))
                : ((b = this.transX - ((n - 1) / t) * s),
                  (g = this.transY - ((n - 1) / t) * a))),
        i && u > 0
            ? ((c = this.scale),
              (h = (t - c) / u),
              (f = this.transX * this.scale),
              (m = this.transY * this.scale),
              (p = (b * t - f) / u),
              (S = (g * t - m) / u),
              (o = setInterval(function () {
                  ((l += 1),
                      (r.scale = c + h * l),
                      (r.transX = (f + p * l) / r.scale),
                      (r.transY = (m + S * l) / r.scale),
                      r._applyTransform(),
                      l == u &&
                          (clearInterval(o),
                          r._emit(_.onViewportChange, [
                              r.scale,
                              r.transX,
                              r.transY,
                          ])));
              }, 10)))
            : ((this.transX = b),
              (this.transY = g),
              (this.scale = t),
              this._applyTransform(),
              this._emit(_.onViewportChange, [
                  this.scale,
                  this.transX,
                  this.transY,
              ])));
}
function Xe(t) {
    var s = this;
    t === void 0 && (t = {});
    var a,
        e = [];
    if ((t.region ? e.push(t.region) : t.regions && (e = t.regions), e.length))
        return (
            e.forEach(function (o) {
                if (s.regions[o]) {
                    var l = s.regions[o].element.shape.getBBox();
                    l &&
                        (typeof a > "u"
                            ? (a = l)
                            : (a = {
                                  x: Math.min(a.x, l.x),
                                  y: Math.min(a.y, l.y),
                                  width:
                                      Math.max(a.x + a.width, l.x + l.width) -
                                      Math.min(a.x, l.x),
                                  height:
                                      Math.max(a.y + a.height, l.y + l.height) -
                                      Math.min(a.y, l.y),
                              }));
                }
            }),
            this._setScale(
                Math.min(this._width / a.width, this._height / a.height),
                -(a.x + a.width / 2),
                -(a.y + a.height / 2),
                !0,
                t.animate,
            )
        );
    if (t.coords) {
        var i = this.coordsToPoint(t.coords[0], t.coords[1]),
            r = this.transX - i.x / this.scale,
            n = this.transY - i.y / this.scale;
        return this._setScale(t.scale * this._baseScale, r, n, !0, t.animate);
    }
}
function ze() {
    ((this._width = this.container.offsetWidth),
        (this._height = this.container.offsetHeight),
        this._resize(),
        this.canvas.setSize(this._width, this._height),
        this._applyTransform());
}
var z = {
    mill: function (s, a, e) {
        return {
            x: this.radius * (a - e) * this.radDeg,
            y:
                (-this.radius *
                    Math.log(Math.tan((45 + 0.4 * s) * this.radDeg))) /
                0.8,
        };
    },
    merc: function (s, a, e) {
        return {
            x: this.radius * (a - e) * this.radDeg,
            y:
                -this.radius *
                Math.log(Math.tan(Math.PI / 4 + (s * Math.PI) / 360)),
        };
    },
    aea: function (s, a, e) {
        var i = 0,
            r = e * this.radDeg,
            n = 29.5 * this.radDeg,
            o = 45.5 * this.radDeg,
            l = s * this.radDeg,
            u = a * this.radDeg,
            c = (Math.sin(n) + Math.sin(o)) / 2,
            h = Math.cos(n) * Math.cos(n) + 2 * c * Math.sin(n),
            f = c * (u - r),
            p = Math.sqrt(h - 2 * c * Math.sin(l)) / c,
            m = Math.sqrt(h - 2 * c * Math.sin(i)) / c;
        return {
            x: p * Math.sin(f) * this.radius,
            y: -(m - p * Math.cos(f)) * this.radius,
        };
    },
    lcc: function (s, a, e) {
        var i = 0,
            r = e * this.radDeg,
            n = a * this.radDeg,
            o = 33 * this.radDeg,
            l = 45 * this.radDeg,
            u = s * this.radDeg,
            c =
                Math.log(Math.cos(o) * (1 / Math.cos(l))) /
                Math.log(
                    Math.tan(Math.PI / 4 + l / 2) *
                        (1 / Math.tan(Math.PI / 4 + o / 2)),
                ),
            h = (Math.cos(o) * Math.pow(Math.tan(Math.PI / 4 + o / 2), c)) / c,
            f = h * Math.pow(1 / Math.tan(Math.PI / 4 + u / 2), c),
            p = h * Math.pow(1 / Math.tan(Math.PI / 4 + i / 2), c);
        return {
            x: f * Math.sin(c * (n - r)) * this.radius,
            y: -(p - f * Math.cos(c * (n - r))) * this.radius,
        };
    },
};
z.degRad = 180 / Math.PI;
z.radDeg = Math.PI / 180;
z.radius = 6381372;
function Pe(t, s) {
    var a = M.maps[this.params.map].projection,
        e = z[a.type](t, s, a.centralMeridian),
        i = e.x,
        r = e.y,
        n = this.getInsetForPoint(i, r);
    if (!n) return !1;
    var o = n.bbox;
    return (
        (i = ((i - o[0].x) / (o[1].x - o[0].x)) * n.width * this.scale),
        (r = ((r - o[0].y) / (o[1].y - o[0].y)) * n.height * this.scale),
        {
            x: i + this.transX * this.scale + n.left * this.scale,
            y: r + this.transY * this.scale + n.top * this.scale,
        }
    );
}
function Re(t, s) {
    for (var a = M.maps[this.params.map].insets, e = 0; e < a.length; e++) {
        var i = a[e].bbox,
            r = i[0],
            n = i[1];
        if (t > r.x && t < n.x && s > r.y && s < n.y) return a[e];
    }
}
function Ie(t) {
    var s = t.coords;
    return M.maps[this.params.map].projection
        ? this.coordsToPoint.apply(this, s)
        : {
              x: s[0] * this.scale + this.transX * this.scale,
              y: s[1] * this.scale + this.transY * this.scale,
          };
}
function De() {
    var t = !1,
        s = !1;
    for (var a in this._lines) {
        for (var e in this._markers) {
            var i = this._markers[e];
            (i.config.name === this._lines[a].config.from &&
                (t = this.getMarkerPosition(i.config)),
                i.config.name === this._lines[a].config.to &&
                    (s = this.getMarkerPosition(i.config)));
        }
        t !== !1 &&
            s !== !1 &&
            this._lines[a].setStyle({ x1: t.x, y1: t.y, x2: s.x, y2: s.y });
    }
}
function Ve() {
    for (var t in this._markers) {
        var s = this.getMarkerPosition(this._markers[t].config);
        s !== !1 && this._markers[t].element.setStyle({ cx: s.x, cy: s.y });
    }
}
function He() {
    var t = this.params.labels;
    if (t) {
        if (t.regions)
            for (var s in this.regions)
                this.regions[s].element.updateLabelPosition();
        if (t.markers)
            for (var a in this._markers)
                this._markers[a].element.updateLabelPosition();
    }
}
var Ge = {
        _setupContainerEvents: ge,
        _setupElementEvents: ve,
        _setupZoomButtons: _e,
        _setupContainerTouchEvents: ye,
        _createRegions: we,
        _createLines: ke,
        _createMarkers: je,
        _createSeries: Oe,
        _applyTransform: Ae,
        _resize: Ce,
        _setScale: Ye,
        setFocus: Xe,
        updateSize: ze,
        coordsToPoint: Pe,
        getInsetForPoint: Re,
        getMarkerPosition: Ie,
        _repositionLines: De,
        _repositionMarkers: Ve,
        _repositionLabels: He,
    },
    We = {
        map: "world",
        backgroundColor: "transparent",
        draggable: !0,
        zoomButtons: !0,
        zoomOnScroll: !0,
        zoomOnScrollSpeed: 3,
        zoomMax: 12,
        zoomMin: 1,
        zoomAnimate: !0,
        showTooltip: !0,
        zoomStep: 1.5,
        bindTouchEvents: !0,
        lineStyle: {
            stroke: "#808080",
            strokeWidth: 1,
            strokeLinecap: "round",
        },
        markersSelectable: !1,
        markersSelectableOne: !1,
        markerStyle: {
            initial: {
                r: 7,
                fill: "#374151",
                fillOpacity: 1,
                stroke: "#FFF",
                strokeWidth: 5,
                strokeOpacity: 0.5,
            },
            hover: { fill: "#3cc0ff", cursor: "pointer" },
            selected: { fill: "blue" },
            selectedHover: {},
        },
        markerLabelStyle: {
            initial: {
                fontFamily: "Verdana",
                fontSize: 12,
                fontWeight: 500,
                cursor: "default",
                fill: "#374151",
            },
            hover: { cursor: "pointer" },
            selected: {},
            selectedHover: {},
        },
        regionsSelectable: !1,
        regionsSelectableOne: !1,
        regionStyle: {
            initial: {
                fill: "#dee2e8",
                fillOpacity: 1,
                stroke: "none",
                strokeWidth: 0,
            },
            hover: { fillOpacity: 0.7, cursor: "pointer" },
            selected: { fill: "#9ca3af" },
            selectedHover: {},
        },
        regionLabelStyle: {
            initial: {
                fontFamily: "Verdana",
                fontSize: "12",
                fontWeight: "bold",
                cursor: "default",
                fill: "#35373e",
            },
            hover: { cursor: "pointer" },
        },
    },
    L = (function () {
        function t(a, e) {
            ((this.node = this._createElement(a)), e && this.set(e));
        }
        var s = t.prototype;
        return (
            (s._createElement = function (e) {
                return document.createElementNS(
                    "http://www.w3.org/2000/svg",
                    e,
                );
            }),
            (s.addClass = function (e) {
                this.node.setAttribute("class", e);
            }),
            (s.getBBox = function () {
                return this.node.getBBox();
            }),
            (s.set = function (e, i) {
                if (typeof e == "object")
                    for (var r in e) this.applyAttr(r, e[r]);
                else this.applyAttr(e, i);
            }),
            (s.get = function (e) {
                return this.style.initial[e];
            }),
            (s.applyAttr = function (e, i) {
                this.node.setAttribute(de(e), i);
            }),
            (s.remove = function () {
                Y(this.node);
            }),
            t
        );
    })(),
    E = (function (t) {
        function s(e, i, r) {
            var n;
            return (
                r === void 0 && (r = {}),
                (n = t.call(this, e, i) || this),
                (n.isHovered = !1),
                (n.isSelected = !1),
                (n.style = r),
                (n.style.current = {}),
                n.updateStyle(),
                n
            );
        }
        w(s, t);
        var a = s.prototype;
        return (
            (a.setStyle = function (i, r) {
                if (typeof i == "object") v(this.style.current, i);
                else {
                    var n;
                    v(this.style.current, ((n = {}), (n[i] = r), n));
                }
                this.updateStyle();
            }),
            (a.updateStyle = function () {
                var i = {};
                (v(i, this.style.initial),
                    v(i, this.style.current),
                    this.isHovered && v(i, this.style.hover),
                    this.isSelected &&
                        (v(i, this.style.selected),
                        this.isHovered && v(i, this.style.selectedHover)),
                    this.set(i));
            }),
            s
        );
    })(L),
    Fe = (function (t) {
        function s(e, i) {
            return t.call(this, "text", e, i) || this;
        }
        w(s, t);
        var a = s.prototype;
        return (
            (a.applyAttr = function (i, r) {
                i === "text"
                    ? (this.node.textContent = r)
                    : t.prototype.applyAttr.call(this, i, r);
            }),
            s
        );
    })(E),
    $e = (function (t) {
        function s(e, i) {
            return t.call(this, "image", e, i) || this;
        }
        w(s, t);
        var a = s.prototype;
        return (
            (a.applyAttr = function (i, r) {
                var n;
                i === "image"
                    ? (typeof r == "object"
                          ? ((n = r.url), (this.offset = r.offset || [0, 0]))
                          : ((n = r), (this.offset = [0, 0])),
                      this.node.setAttributeNS(
                          "http://www.w3.org/1999/xlink",
                          "href",
                          n,
                      ),
                      (this.width = 23),
                      (this.height = 23),
                      this.applyAttr("width", this.width),
                      this.applyAttr("height", this.height),
                      this.applyAttr(
                          "x",
                          this.cx - this.width / 2 + this.offset[0],
                      ),
                      this.applyAttr(
                          "y",
                          this.cy - this.height / 2 + this.offset[1],
                      ))
                    : i == "cx"
                      ? ((this.cx = r),
                        this.width &&
                            this.applyAttr(
                                "x",
                                r - this.width / 2 + this.offset[0],
                            ))
                      : i == "cy"
                        ? ((this.cy = r),
                          this.height &&
                              this.applyAttr(
                                  "y",
                                  r - this.height / 2 + this.offset[1],
                              ))
                        : t.prototype.applyAttr.apply(this, arguments);
            }),
            s
        );
    })(E),
    Be = (function (t) {
        function s(e) {
            var i;
            return (
                (i = t.call(this, "svg") || this),
                (i._container = e),
                (i._defsElement = new L("defs")),
                (i._rootElement = new L("g", { id: "jvm-regions-group" })),
                i.node.appendChild(i._defsElement.node),
                i.node.appendChild(i._rootElement.node),
                i._container.appendChild(i.node),
                i
            );
        }
        w(s, t);
        var a = s.prototype;
        return (
            (a.setSize = function (i, r) {
                (this.node.setAttribute("width", i),
                    this.node.setAttribute("height", r));
            }),
            (a.applyTransformParams = function (i, r, n) {
                this._rootElement.node.setAttribute(
                    "transform",
                    "scale(" + i + ") translate(" + r + ", " + n + ")",
                );
            }),
            (a.createPath = function (i, r) {
                var n = new E("path", i, r);
                return (
                    n.node.setAttribute("fill-rule", "evenodd"),
                    this._add(n)
                );
            }),
            (a.createCircle = function (i, r, n) {
                var o = new E("circle", i, r);
                return this._add(o, n);
            }),
            (a.createLine = function (i, r, n) {
                var o = new E("line", i, r);
                return this._add(o, n);
            }),
            (a.createText = function (i, r, n) {
                var o = new Fe(i, r);
                return this._add(o, n);
            }),
            (a.createImage = function (i, r, n) {
                var o = new $e(i, r);
                return this._add(o, n);
            }),
            (a.createGroup = function (i) {
                var r = new L("g");
                return (
                    this.node.appendChild(r.node),
                    i && (r.node.id = i),
                    (r.canvas = this),
                    r
                );
            }),
            (a._add = function (i, r) {
                return (
                    (r = r || this._rootElement),
                    r.node.appendChild(i.node),
                    i
                );
            }),
            s
        );
    })(L),
    Ne = (function (t) {
        function s(e) {
            var i;
            i = t.call(this) || this;
            var r = y("div", "jvm-tooltip");
            return (
                (i._map = e),
                (i._tooltip = document.body.appendChild(r)),
                i._bindEventListeners(),
                i || be(i)
            );
        }
        w(s, t);
        var a = s.prototype;
        return (
            (a._bindEventListeners = function () {
                var i = this;
                d.on(this._map.container, "mousemove", function (r) {
                    if (i._tooltip.classList.contains("active")) {
                        var n = fe(
                                i._map.container,
                                "#jvm-regions-group",
                            ).getBoundingClientRect(),
                            o = 5,
                            l = i._tooltip.getBoundingClientRect(),
                            u = l.height,
                            c = l.width,
                            h = r.clientY <= n.top + u + o,
                            f = r.pageY - u - o,
                            p = r.pageX - c - o;
                        (h && ((f += u + o), (p -= o * 2)),
                            r.clientX < n.left + c + o &&
                                ((p = r.pageX + o + 2), h && (p += o * 2)),
                            i.css({ top: f + "px", left: p + "px" }));
                    }
                });
            }),
            (a.getElement = function () {
                return this._tooltip;
            }),
            (a.show = function () {
                this._tooltip.classList.add("active");
            }),
            (a.hide = function () {
                this._tooltip.classList.remove("active");
            }),
            (a.text = function (i, r) {
                r === void 0 && (r = !1);
                var n = r ? "innerHTML" : "textContent";
                if (!i) return this._tooltip[n];
                this._tooltip[n] = i;
            }),
            (a.css = function (i) {
                for (var r in i) this._tooltip.style[r] = i[r];
                return this;
            }),
            s
        );
    })(X),
    qe = (function () {
        function t(a, e) {
            var i = a.scale,
                r = a.values;
            ((this._scale = i),
                (this._values = r),
                (this._fromColor = this.hexToRgb(i[0])),
                (this._toColor = this.hexToRgb(i[1])),
                (this._map = e),
                this.setMinMaxValues(r),
                this.visualize());
        }
        var s = t.prototype;
        return (
            (s.setMinMaxValues = function (e) {
                ((this.min = Number.MAX_VALUE), (this.max = 0));
                for (var i in e)
                    ((i = parseFloat(e[i])),
                        i > this.max && (this.max = i),
                        i < this.min && (this.min = i));
            }),
            (s.visualize = function () {
                var e = {},
                    i;
                for (var r in this._values)
                    ((i = parseFloat(this._values[r])),
                        isNaN(i) || (e[r] = this.getValue(i)));
                this.setAttributes(e);
            }),
            (s.setAttributes = function (e) {
                for (var i in e)
                    this._map.regions[i] &&
                        this._map.regions[i].element.setStyle("fill", e[i]);
            }),
            (s.getValue = function (e) {
                if (this.min === this.max) return "#" + this._toColor.join("");
                for (var i, r = "#", n = 0; n < 3; n++)
                    ((i = Math.round(
                        this._fromColor[n] +
                            (this._toColor[n] - this._fromColor[n]) *
                                ((e - this.min) / (this.max - this.min)),
                    ).toString(16)),
                        (r += (i.length === 1 ? "0" : "") + i));
                return r;
            }),
            (s.hexToRgb = function (e) {
                var i = 0,
                    r = 0,
                    n = 0;
                return (
                    e.length == 4
                        ? ((i = "0x" + e[1] + e[1]),
                          (r = "0x" + e[2] + e[2]),
                          (n = "0x" + e[3] + e[3]))
                        : e.length == 7 &&
                          ((i = "0x" + e[1] + e[2]),
                          (r = "0x" + e[3] + e[4]),
                          (n = "0x" + e[5] + e[6])),
                    [parseInt(i), parseInt(r), parseInt(n)]
                );
            }),
            t
        );
    })(),
    M = (function () {
        function t(a) {
            var e = this;
            if (
                (a === void 0 && (a = {}),
                (this.params = v(t.defaults, a, !0)),
                !t.maps[this.params.map])
            )
                throw new Error(
                    "Attempt to use map which was not loaded: " + a.map,
                );
            ((this.regions = {}),
                (this.scale = 1),
                (this.transX = 0),
                (this.transY = 0),
                (this._mapData = t.maps[this.params.map]),
                (this._markers = {}),
                (this._lines = {}),
                (this._defaultWidth = this._mapData.width),
                (this._defaultHeight = this._mapData.height),
                (this._height = 0),
                (this._width = 0),
                (this._baseScale = 1),
                (this._baseTransX = 0),
                (this._baseTransY = 0),
                document.readyState !== "loading"
                    ? this._init()
                    : window.addEventListener("DOMContentLoaded", function () {
                          return e._init();
                      }));
        }
        var s = t.prototype;
        return (
            (s._init = function () {
                var e = this.params;
                ((this.container = W(e.selector)),
                    this.container.classList.add("jvm-container"),
                    (this.canvas = new Be(this.container)),
                    this.setBackgroundColor(e.backgroundColor),
                    this._createRegions(),
                    this.updateSize(),
                    this._createLines(e.lines || {}, e.markers || {}),
                    this._createMarkers(e.markers),
                    this._repositionLabels(),
                    this._setupContainerEvents(),
                    this._setupElementEvents(),
                    e.zoomButtons && this._setupZoomButtons(),
                    e.showTooltip && (this._tooltip = new Ne(this)),
                    e.selectedRegions &&
                        this._setSelected("regions", e.selectedRegions),
                    e.selectedMarkers &&
                        this._setSelected("_markers", e.selectedMarkers),
                    e.focusOn && this.setFocus(e.focusOn),
                    e.visualizeData &&
                        (this.dataVisualization = new qe(
                            e.visualizeData,
                            this,
                        )),
                    e.bindTouchEvents &&
                        ("ontouchstart" in window ||
                            (window.DocumentTouch &&
                                document instanceof DocumentTouch)) &&
                        this._setupContainerTouchEvents(),
                    e.series &&
                        (this.container.appendChild(
                            (this.legendHorizontal = y(
                                "div",
                                "jvm-series-container jvm-series-h",
                            )),
                        ),
                        this.container.appendChild(
                            (this.legendVertical = y(
                                "div",
                                "jvm-series-container jvm-series-v",
                            )),
                        ),
                        this._createSeries()),
                    this._emit(_.onLoaded, [this]));
            }),
            (s.setBackgroundColor = function (e) {
                this.container.style.backgroundColor = e;
            }),
            (s.getSelectedRegions = function () {
                return this._getSelected("regions");
            }),
            (s.clearSelectedRegions = function (e) {
                var i = this;
                (e === void 0 && (e = void 0),
                    (e =
                        this._normalizeRegions(e) ||
                        this._getSelected("regions")),
                    e.forEach(function (r) {
                        i.regions[r].element.select(!1);
                    }));
            }),
            (s.setSelectedRegions = function (e) {
                (this.clearSelectedRegions(),
                    this._setSelected("regions", this._normalizeRegions(e)));
            }),
            (s.getSelectedMarkers = function () {
                return this._getSelected("_markers");
            }),
            (s.clearSelectedMarkers = function () {
                this._clearSelected("_markers");
            }),
            (s.addMarkers = function (e) {
                ((e = Array.isArray(e) ? e : [e]), this._createMarkers(e, !0));
            }),
            (s.removeMarkers = function (e) {
                var i = this;
                (e || (e = Object.keys(this._markers)),
                    e.forEach(function (r) {
                        (i._markers[r].element.remove(), delete i._markers[r]);
                    }));
            }),
            (s.addLine = function (e, i, r) {
                (r === void 0 && (r = {}),
                    console.warn(
                        "`addLine` method is deprecated, please use `addLines` instead.",
                    ),
                    this._createLines(
                        [{ from: e, to: i, style: r }],
                        this._markers,
                        !0,
                    ));
            }),
            (s.addLines = function (e) {
                var i = this._getLinesAsUids();
                (Array.isArray(e) || (e = [e]),
                    this._createLines(
                        e.filter(function (r) {
                            return !(i.indexOf(A(r.from, r.to)) > -1);
                        }),
                        this._markers,
                        !0,
                    ));
            }),
            (s.removeLines = function (e) {
                var i = this;
                (Array.isArray(e)
                    ? (e = e.map(function (r) {
                          return A(r.from, r.to);
                      }))
                    : (e = this._getLinesAsUids()),
                    e.forEach(function (r) {
                        (i._lines[r].dispose(), delete i._lines[r]);
                    }));
            }),
            (s.removeLine = function (e, i) {
                console.warn(
                    "`removeLine` method is deprecated, please use `removeLines` instead.",
                );
                var r = A(e, i);
                this._lines.hasOwnProperty(r) &&
                    (this._lines[r].element.remove(), delete this._lines[r]);
            }),
            (s.reset = function () {
                for (var e in this.series)
                    for (var i = 0; i < this.series[e].length; i++)
                        this.series[e][i].clear();
                (this.legendHorizontal &&
                    (Y(this.legendHorizontal), (this.legendHorizontal = null)),
                    this.legendVertical &&
                        (Y(this.legendVertical), (this.legendVertical = null)),
                    (this.scale = this._baseScale),
                    (this.transX = this._baseTransX),
                    (this.transY = this._baseTransY),
                    this._applyTransform(),
                    this.clearSelectedMarkers(),
                    this.clearSelectedRegions(),
                    this.removeMarkers());
            }),
            (s.destroy = function (e) {
                var i = this;
                (e === void 0 && (e = !0),
                    d.flush(),
                    this._tooltip.dispose(),
                    this._emit(_.onDestroyed),
                    e &&
                        Object.keys(this).forEach(function (r) {
                            try {
                                delete i[r];
                            } catch {}
                        }));
            }),
            (s.extend = function (e, i) {
                if (typeof this[e] == "function")
                    throw new Error(
                        "The method [" +
                            e +
                            "] does already exist, please use another name.",
                    );
                t.prototype[e] = i;
            }),
            (s._emit = function (e, i) {
                for (var r in _)
                    _[r] === e &&
                        typeof this.params[r] == "function" &&
                        this.params[r].apply(this, i);
            }),
            (s._getSelected = function (e) {
                var i = [];
                for (var r in this[e])
                    this[e][r].element.isSelected && i.push(r);
                return i;
            }),
            (s._setSelected = function (e, i) {
                var r = this;
                i.forEach(function (n) {
                    r[e][n] && r[e][n].element.select(!0);
                });
            }),
            (s._clearSelected = function (e) {
                var i = this;
                this._getSelected(e).forEach(function (r) {
                    i[e][r].element.select(!1);
                });
            }),
            (s._getLinesAsUids = function () {
                return Object.keys(this._lines);
            }),
            (s._normalizeRegions = function (e) {
                return typeof e == "string" ? [e] : e;
            }),
            t
        );
    })();
M.maps = {};
M.defaults = We;
Object.assign(M.prototype, Ge);
var Ue = (function () {
        function t(s) {
            if ((s === void 0 && (s = {}), !s.selector))
                throw new Error("Selector is not given.");
            return new M(s);
        }
        return (
            (t.addMap = function (a, e) {
                M.maps[a] = e;
            }),
            t
        );
    })(),
    q = (window.jsVectorMap = Ue);
var O = {},
    D = {},
    Ze = (t) => document.querySelector(`script[src="${t}"]`) !== null,
    Ke = (t, s) => {
        (O[t] || (O[t] = []), O[t].push(s));
    },
    U = (t) => {
        if (D[t]) for (; O[t]?.length; ) O[t].shift()();
    },
    Je = (t) => {
        let s = document.createElement("script");
        ((s.textContent = t), document.head.appendChild(s));
    },
    Z = (t, s) => {
        if ((Ke(t, s), D[t])) {
            U(t);
            return;
        }
        Ze(t) ||
            fetch(t)
                .then((a) => {
                    if (!a.ok) throw new Error(`Failed to fetch script: ${t}`);
                    return a.text();
                })
                .then((a) => {
                    (Je(a), (D[t] = !0), U(t));
                })
                .catch((a) => {
                    console.error(`Failed to load script content: ${t}`, {
                        error: a,
                        src: t,
                        currentTime: new Date(),
                    });
                });
    };
function K({
    stats: t,
    tooltipText: s,
    map: a,
    customMapUrl: e = "",
    color: i,
    selector: r,
    additionalOptions: n = {},
}) {
    return {
        stats: t,
        init() {
            let o = this,
                l =
                    e != ""
                        ? e
                        : `https://raw.githubusercontent.com/themustafaomar/jsvectormap/master/src/maps/${a.replace(/_/g, "-")}.js`;
            Z(l, () => {
                let u = o.stats,
                    c = Math.min(...Object.values(u)),
                    h = Math.max(...Object.values(u)),
                    f = (g, x, j) => 0.3 + ((g - x) / (j - x)) * (1 - 0.3),
                    p = Object.fromEntries(
                        Object.entries(u).map(([g, x]) => {
                            let j = f(x, c, h);
                            return [
                                g,
                                `rgba(${i[0]}, ${i[1]}, ${i[2]}, ${j.toFixed(2)})`,
                            ];
                        }),
                    ),
                    m = Object.fromEntries(
                        Object.entries(u).map(([g]) => [g, g]),
                    ),
                    S = {
                        selector: r,
                        map: a,
                        series: {
                            regions: [
                                { attribute: "fill", scale: p, values: m },
                            ],
                        },
                        showTooltip: !0,
                        onRegionTooltipShow(g, x, j) {
                            let J = o.stats[j.toUpperCase()] || 0;
                            x.text(`<h5>${x.text()}: ${J} ${s}</h5>`, !0);
                        },
                    },
                    b = {
                        ...S,
                        ...n,
                        series: {
                            regions: [
                                {
                                    ...S.series.regions[0],
                                    ...n.series?.regions?.[0],
                                },
                            ],
                        },
                    };
                new q(b);
            });
        },
    };
}
document.addEventListener("alpine:init", () => {
    Alpine.data("initWorldMapWidget", K);
});
export { K as default };
