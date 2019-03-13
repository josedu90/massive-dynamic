
//----------------------------------------------------------
//                          Google Map
//-----------------------------------------------------------
function pixflow_googleMap(id, lat, lon, zoom, type, icon , customStyle) {
    "use strict";
    if ($(".md-google-map").length) {
        var options = {
            zoom: parseInt(zoom),
            disableDefaultUI: true, //  disabling zoom in touch devices
            disableDoubleClickZoom: true, //  disabling zoom by double click on map
            center: new google.maps.LatLng(lat, lon),
            draggable: true, //  disable map dragging
            mapTypeControl: true,
            navigationControl: false,
            scrollwheel: false,
            streetViewControl: false,
            panControl: false,
            zoomControl: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, "Gray"]
            }
        };

        var markers = {
            values: [{
                'latLng': [lat, lon]
            }],
            options: {
                icon: new google.maps.MarkerImage(icon, new google.maps.Size(80, 60, "px", "px"))
            }
        };

        if (type == 'gray') {
            $("." + id).gmap3({
                map: { options: options } ,
                styledmaptype: {
                    id: "Gray",
                    options: {
                        name: "Gray"
                    },
                    styles: [
                        {
                            featureType: "water",
                            elementType: "geometry",
                            stylers: [
                                {color: "#1d1d1d"}
                            ]
                        }, {
                            featureType: "landscape",
                            stylers: [
                                {color: "#3e3e3e"},
                                {lightness: 7}
                            ]
                        }, {
                            featureType: "administrative.country",
                            elementType: "geometry.stroke",
                            stylers: [
                                {color: "#5f5f5f"},
                                {weight: 1}
                            ]
                        }, {
                            featureType: "landscape.natural.terrain",
                            stylers: [
                                {color: "#4f4f4f"}
                            ]
                        }, {
                            featureType: "road",
                            stylers: [
                                {color: "#393939"}
                            ]
                        }, {
                            featureType: "administrative.country",
                            elementType: "labels",
                            stylers: [
                                {visibility: "on"},
                                {weight: 0.4},
                                {color: "#686868"}
                            ]
                        }, {
                            eatureType: "administrative.locality",
                            elementType: "labels.text.fill",
                            stylers: [
                                {weigh: 2.4},
                                {color: "#9b9b9b"}
                            ]
                        }, {
                            featureType: "administrative.locality",
                            elementType: "labels.text",
                            stylers: [
                                {visibility: "on"},
                                {lightness: -80}
                            ]
                        }, {
                            featureType: "poi",
                            stylers: [
                                {visibility: "off"},
                                {color: "#d78080"}
                            ]
                        }, {
                            featureType: "administrative.province",
                            elementType: "geometry",
                            stylers: [
                                {visibility: "on"},
                                {lightness: -80}
                            ]
                        }, {
                            featureType: "water",
                            elementType: "labels",
                            stylers: [
                                {color: "#adadad"},
                                {weight: 0.1}
                            ]
                        }, {
                            featureType: "administrative.province",
                            elementType: "labels.text.fill",
                            stylers: [
                                {color: "#3a3a3a"},
                                {weight: 4.8},
                                {lightness: -69}
                            ]
                        }

                    ]
                },
                marker: markers
            });
            $('.' + id).gmap3('get').setMapTypeId("Gray");//Display Gray Map On Load  if we don't have this line map loads in default
            if ($(window).width() <= 1280) {
                $("." + id).gmap3("get").setOptions({draggable: false});
            }

        } else if (type == 'ultralight' ){
            $("." + id).gmap3({
                map: { options: options },
                styledmaptype: {
                    id: "Ultralight",
                    options: {
                        name: "ultralight"
                    },
                    styles: [
                        {
                            "featureType": "water",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#e9e9e9"
                                },
                                {
                                    "lightness": 17
                                }
                            ]
                        },
                        {
                            "featureType": "landscape",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#f5f5f5"
                                },
                                {
                                    "lightness": 20
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "color": "#ffffff"
                                },
                                {
                                    "lightness": 17
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry.stroke",
                            "stylers": [
                                {
                                    "color": "#ffffff"
                                },
                                {
                                    "lightness": 29
                                },
                                {
                                    "weight": 0.2
                                }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#ffffff"
                                },
                                {
                                    "lightness": 18
                                }
                            ]
                        },
                        {
                            "featureType": "road.local",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#ffffff"
                                },
                                {
                                    "lightness": 16
                                }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#f5f5f5"
                                },
                                {
                                    "lightness": 21
                                }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#dedede"
                                },
                                {
                                    "lightness": 21
                                }
                            ]
                        },
                        {
                            "elementType": "labels.text.stroke",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "color": "#ffffff"
                                },
                                {
                                    "lightness": 16
                                }
                            ]
                        },
                        {
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "saturation": 36
                                },
                                {
                                    "color": "#333333"
                                },
                                {
                                    "lightness": 40
                                }
                            ]
                        },
                        {
                            "elementType": "labels.icon",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#f2f2f2"
                                },
                                {
                                    "lightness": 19
                                }
                            ]
                        },
                        {
                            "featureType": "administrative",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "color": "#fefefe"
                                },
                                {
                                    "lightness": 20
                                }
                            ]
                        },
                        {
                            "featureType": "administrative",
                            "elementType": "geometry.stroke",
                            "stylers": [
                                {
                                    "color": "#fefefe"
                                },
                                {
                                    "lightness": 17
                                },
                                {
                                    "weight": 1.2
                                }
                            ]
                        }
                    ]
                },
                marker: markers
            });
            $('.' + id).gmap3('get').setMapTypeId("Ultralight");//Display Gray Map On Load  if we don't have this line map loads in default
            if ($(window).width() <= 1280) {
                $("." + id).gmap3("get").setOptions({draggable: false});
            }
        } else if (type == 'custom' ){

        } else if (type == 'blueone' ){
            $("." + id).gmap3({
                map: { options: options },
                styledmaptype: {
                    id: "Blueone",
                    options: {
                        name: "blueone"
                    },
                    styles: [
                        {
                            "featureType": "administrative",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "color": "#444444"
                                }
                            ]
                        },
                        {
                            "featureType": "landscape",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "color": "#f2f2f2"
                                }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "saturation": -100
                                },
                                {
                                    "lightness": 45
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "simplified"
                                }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "labels.icon",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "color": "#46bcec"
                                },
                                {
                                    "visibility": "on"
                                }
                            ]
                        }
                    ]
                },
                marker: markers
            });
            $('.' + id).gmap3('get').setMapTypeId("Blueone");//Display Gray Map On Load  if we don't have this line map loads in default
            if ($(window).width() <= 1280) {
                $("." + id).gmap3("get").setOptions({draggable: false});
            }
        }
        else if (type == 'grayscale' ){
            $("." + id).gmap3({
                map: { options: options } ,
                styledmaptype: {
                    id: "Grayscale",
                    options: {
                        name: "grayscale"
                    },
                    styles: [
                        {
                            "featureType": "administrative",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "saturation": "-100"
                                }
                            ]
                        },
                        {
                            "featureType": "administrative.province",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "landscape",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "saturation": -100
                                },
                                {
                                    "lightness": 65
                                },
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "saturation": -100
                                },
                                {
                                    "lightness": "50"
                                },
                                {
                                    "visibility": "simplified"
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "saturation": "-100"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "simplified"
                                }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "lightness": "30"
                                }
                            ]
                        },
                        {
                            "featureType": "road.local",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "lightness": "40"
                                }
                            ]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "saturation": -100
                                },
                                {
                                    "visibility": "simplified"
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "hue": "#ffff00"
                                },
                                {
                                    "lightness": -25
                                },
                                {
                                    "saturation": -97
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "labels",
                            "stylers": [
                                {
                                    "lightness": -25
                                },
                                {
                                    "saturation": -100
                                }
                            ]
                        }
                    ]
                },
                marker: markers
            });
            $('.' + id).gmap3('get').setMapTypeId("Grayscale");//Display Gray Map On Load  if we don't have this line map loads in default
            if ($(window).width() <= 1280) {
                $("." + id).gmap3("get").setOptions({draggable: false});
            }
        }
        else if (type == 'lightdream' ){
            $("." + id).gmap3({
                map: { options: options },
                styledmaptype: {
                    id: "Lightdream",
                    options: {
                        name: "lightdream"
                    },
                    styles: [
                        {
                            "featureType": "landscape",
                            "stylers": [
                                {
                                    "hue": "#FFBB00"
                                },
                                {
                                    "saturation": 43.400000000000006
                                },
                                {
                                    "lightness": 37.599999999999994
                                },
                                {
                                    "gamma": 1
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "stylers": [
                                {
                                    "hue": "#FFC200"
                                },
                                {
                                    "saturation": -61.8
                                },
                                {
                                    "lightness": 45.599999999999994
                                },
                                {
                                    "gamma": 1
                                }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "stylers": [
                                {
                                    "hue": "#FF0300"
                                },
                                {
                                    "saturation": -100
                                },
                                {
                                    "lightness": 51.19999999999999
                                },
                                {
                                    "gamma": 1
                                }
                            ]
                        },
                        {
                            "featureType": "road.local",
                            "stylers": [
                                {
                                    "hue": "#FF0300"
                                },
                                {
                                    "saturation": -100
                                },
                                {
                                    "lightness": 52
                                },
                                {
                                    "gamma": 1
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "stylers": [
                                {
                                    "hue": "#0078FF"
                                },
                                {
                                    "saturation": -13.200000000000003
                                },
                                {
                                    "lightness": 2.4000000000000057
                                },
                                {
                                    "gamma": 1
                                }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "stylers": [
                                {
                                    "hue": "#00FF6A"
                                },
                                {
                                    "saturation": -1.0989010989011234
                                },
                                {
                                    "lightness": 11.200000000000017
                                },
                                {
                                    "gamma": 1
                                }
                            ]
                        }
                    ]
                },
                marker: markers
            });
            $('.' + id).gmap3('get').setMapTypeId("lightdream");//Display Gray Map On Load  if we don't have this line map loads in default
            if ($(window).width() <= 1280) {
                $("." + id).gmap3("get").setOptions({draggable: false});
            }
        } else {
            $("." + id).gmap3({
                map: { options: options },
                marker: markers
            });

        }
    }

}