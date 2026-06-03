# UI Code Generation Task

You are a senior frontend engineer specializing in Vue 3 (Composition API, TypeScript) and Tailwind CSS v4. Your task is to convert a Figma design specification into production-ready code that is **100% visually identical** to the original design.

**IMPORTANT: You must CREATE NEW FILES or EDIT/UPDATE EXISTING FILES** as needed to implement this design. Do not just provide code snippets — generate complete, ready-to-use files that can be saved directly to the project.

**Technology Stack:**
- Framework: Vue 3 (Composition API, TypeScript)
- Styling: Tailwind CSS v4
- Responsive: Yes

**Your Goal:**
Produce code that renders a UI **indistinguishable from the Figma design**. Every pixel, every spacing value, every color, every font size, every shadow, every border radius must match exactly. The generated UI should look like a screenshot of the Figma design.

---

# Design Specification

```json
{
  "id": "4:75",
  "name": "dashboard-1",
  "width": 1151,
  "height": 1070,
  "layout": {
    "mode": "vertical"
  },
  "background": {
    "type": "solid",
    "value": "#f9f8f6"
  },
  "overflow": "visible",
  "children": [
    {
      "id": "4:76",
      "name": "Body",
      "type": "container",
      "visible": true,
      "width": 1151.2000732421875,
      "height": 775.2000122070312,
      "x": 0,
      "y": 0,
      "layout": {
        "mode": "vertical"
      },
      "layoutSelf": {
        "align": "auto",
        "sizing": {
          "horizontal": "fixed",
          "vertical": "fixed"
        }
      },
      "children": [
        {
          "id": "4:77",
          "name": "MainLayout",
          "type": "container",
          "visible": true,
          "width": 1151.2000732421875,
          "height": 1070.9000244140625,
          "x": 0,
          "y": 0,
          "layout": {
            "mode": "vertical"
          },
          "layoutSelf": {
            "align": "stretch",
            "sizing": {
              "horizontal": "fill",
              "vertical": "hug"
            }
          },
          "background": {
            "type": "solid",
            "value": "#f9f8f6"
          },
          "children": [
            {
              "id": "4:78",
              "name": "Container (margin)",
              "type": "container",
              "visible": true,
              "width": 1151.2000732421875,
              "height": 1070.9000244140625,
              "x": 0,
              "y": 0,
              "layout": {
                "mode": "vertical",
                "padding": {
                  "top": 0,
                  "right": 0,
                  "bottom": 0,
                  "left": 256
                }
              },
              "layoutSelf": {
                "align": "stretch",
                "sizing": {
                  "horizontal": "fill",
                  "vertical": "hug"
                }
              },
              "children": [
                {
                  "id": "4:79",
                  "name": "Container",
                  "type": "container",
                  "visible": true,
                  "width": 895.2000122070312,
                  "height": 1070.9000244140625,
                  "x": 256,
                  "y": 0,
                  "layout": {
                    "mode": "vertical"
                  },
                  "layoutSelf": {
                    "align": "stretch",
                    "sizing": {
                      "horizontal": "fill",
                      "vertical": "hug"
                    }
                  },
                  "children": [
                    {
                      "id": "4:80",
                      "name": "Header",
                      "type": "container",
                      "visible": true,
                      "width": 895.2000122070312,
                      "height": 73.5999984741211,
                      "x": 0,
                      "y": 0,
                      "layout": {
                        "mode": "vertical"
                      },
                      "layoutSelf": {
                        "align": "stretch",
                        "sizing": {
                          "horizontal": "fill",
                          "vertical": "hug"
                        }
                      },
                      "background": {
                        "type": "solid",
                        "value": "#f9f8f6"
                      },
                      "border": {
                        "color": "#000000",
                        "width": 1,
                        "style": "solid",
                        "position": "inside"
                      },
                      "children": [
                        {
                          "id": "4:81",
                          "name": "Container",
                          "type": "container",
                          "visible": true,
                          "width": 895.2000122070312,
                          "height": 72,
                          "x": 0,
                          "y": 0,
                          "layout": {
                            "mode": "horizontal",
                            "justifyContent": "space-between",
                            "alignItems": "center",
                            "padding": {
                              "top": 16,
                              "right": 32,
                              "bottom": 16,
                              "left": 32
                            }
                          },
                          "layoutSelf": {
                            "align": "stretch",
                            "sizing": {
                              "horizontal": "fill",
                              "vertical": "hug"
                            }
                          },
                          "children": [
                            {
                              "id": "4:82",
                              "name": "Container",
                              "type": "container",
                              "visible": true,
                              "width": 181.96250915527344,
                              "height": 15.987500190734863,
                              "x": 32,
                              "y": 28,
                              "layout": {
                                "mode": "horizontal",
                                "alignItems": "center",
                                "gap": 8
                              },
                              "layoutSelf": {
                                "align": "auto",
                                "sizing": {
                                  "horizontal": "hug",
                                  "vertical": "hug"
                                }
                              },
                              "children": [
                                {
                                  "id": "4:83",
                                  "name": "Text",
                                  "type": "container",
                                  "visible": true,
                                  "width": 98.51250457763672,
                                  "height": 15.987500190734863,
                                  "x": 0,
                                  "y": 0,
                                  "layoutSelf": {
                                    "align": "auto",
                                    "sizing": {
                                      "horizontal": "fixed",
                                      "vertical": "fixed"
                                    }
                                  },
                                  "children": [
                                    {
                                      "id": "4:84",
                                      "name": "Workspace /",
                                      "type": "text",
                                      "visible": true,
                                      "width": 98,
                                      "height": 16,
                                      "x": 0,
                                      "y": 0,
                                      "background": {
                                        "type": "solid",
                                        "value": "#525252"
                                      },
                                      "text": {
                                        "content": "Workspace /",
                                        "fontFamily": "Inter",
                                        "fontSize": 12,
                                        "fontWeight": 800,
                                        "lineHeight": 16,
                                        "letterSpacing": 1.2000000476837158,
                                        "textAlign": "left",
                                        "verticalAlign": "top",
                                        "color": "#525252",
                                        "textDecoration": "none",
                                        "textTransform": "uppercase"
                                      }
                                    }
                                  ]
                                },
                                {
                                  "id": "4:85",
                                  "name": "Text",
                                  "type": "container",
                                  "visible": true,
                                  "width": 75.45000457763672,
                                  "height": 15.987500190734863,
                                  "x": 107,
                                  "y": 0,
                                  "layoutSelf": {
                                    "align": "auto",
                                    "sizing": {
                                      "horizontal": "fixed",
                                      "vertical": "fixed"
                                    }
                                  },
                                  "children": [
                                    {
                                      "id": "4:86",
                                      "name": "Acme Inc.",
                                      "type": "text",
                                      "visible": true,
                                      "width": 74,
                                      "height": 16,
                                      "x": 0,
                                      "y": 0,
                                      "background": {
                                        "type": "solid",
                                        "value": "#000000"
                                      },
                                      "text": {
                                        "content": "Acme Inc.",
                                        "fontFamily": "Inter",
                                        "fontSize": 12,
                                        "fontWeight": 800,
                                        "lineHeight": 16,
                                        "letterSpacing": 1.2000000476837158,
                                        "textAlign": "left",
                                        "verticalAlign": "top",
                                        "color": "#000000",
                                        "textDecoration": "none",
                                        "textTransform": "uppercase"
                                      }
                                    }
                                  ]
                                }
                              ]
                            },
                            {
                              "id": "4:87",
                              "name": "Container",
                              "type": "container",
                              "visible": true,
                              "width": 273.20001220703125,
                              "height": 40,
                              "x": 590,
                              "y": 16,
                              "layout": {
                                "mode": "horizontal",
                                "alignItems": "center",
                                "gap": 12
                              },
                              "layoutSelf": {
                                "align": "auto",
                                "sizing": {
                                  "horizontal": "hug",
                                  "vertical": "hug"
                                }
                              },
                              "children": [
                                {
                                  "id": "4:88",
                                  "name": "Button",
                                  "type": "button",
                                  "visible": true,
                                  "width": 40,
                                  "height": 40,
                                  "x": 0,
                                  "y": 0,
                                  "layout": {
                                    "mode": "horizontal",
                                    "justifyContent": "center",
                                    "alignItems": "center"
                                  },
                                  "layoutSelf": {
                                    "align": "auto",
                                    "sizing": {
                                      "horizontal": "fixed",
                                      "vertical": "fixed"
                                    }
                                  },
                                  "background": {
                                    "type": "solid",
                                    "value": "#ffffff"
                                  },
                                  "border": {
                                    "color": "#000000",
                                    "width": 1.600000023841858,
                                    "style": "solid",
                                    "position": "inside"
                                  },
                                  "shadow": [
                                    {
                                      "type": "drop",
                                      "color": "rgba(0, 0, 0, 1.00)",
                                      "offsetX": 2,
                                      "offsetY": 2,
                                      "blur": 0,
                                      "spread": 0
                                    }
                                  ],
                                  "children": [
                                    {
                                      "id": "4:89",
                                      "name": "Icon",
                                      "type": "icon",
                                      "visible": true,
                                      "width": 16,
                                      "height": 16,
                                      "x": 12,
                                      "y": 12,
                                      "layoutSelf": {
                                        "align": "auto",
                                        "sizing": {
                                          "horizontal": "fixed",
                                          "vertical": "fixed"
                                        }
                                      },
                                      "children": [
                                        {
                                          "id": "4:90",
                                          "name": "Vector",
                                          "type": "icon",
                                          "visible": true,
                                          "width": 2.3093338012695312,
                                          "height": 0.6666082143783569,
                                          "x": 7,
                                          "y": 14,
                                          "border": {
                                            "color": "#000000",
                                            "width": 1.6666667461395264,
                                            "style": "solid",
                                            "position": "center"
                                          }
                                        },
                                        {
                                          "id": "4:91",
                                          "name": "Vector",
                                          "type": "icon",
                                          "visible": true,
                                          "width": 11.999752044677734,
                                          "height": 10,
                                          "x": 2,
                                          "y": 1,
                                          "border": {
                                            "color": "#000000",
                                            "width": 1.6666667461395264,
                                            "style": "solid",
                                            "position": "center"
                                          }
                                        }
                                      ]
                                    }
                                  ]
                                },
                                {
                                  "id": "4:92",
                                  "name": "Button",
                                  "type": "button",
                                  "visible": true,
                                  "width": 40,
                                  "height": 40,
                                  "x": 52,
                                  "y": 0,
                                  "layout": {
                                    "mode": "horizontal",
                                    "justifyContent": "center",
                                    "alignItems": "center"
                                  },
                                  "layoutSelf": {
                                    "align": "auto",
                                    "sizing": {
                                      "horizontal": "fixed",
                                      "vertical": "fixed"
                                    }
                                  },
                                  "background": {
                                    "type": "solid",
                                    "value": "#ffffff"
                                  },
                                  "border": {
                                    "color": "#000000",
                                    "width": 1.600000023841858,
                                    "style": "solid",
                                    "position": "inside"
                                  },
                                  "shadow": [
                                    {
                                      "type": "drop",
                                      "color": "rgba(0, 0, 0, 1.00)",
                                      "offsetX": 2,
                                      "offsetY": 2,
                                      "blur": 0,
                                      "spread": 0
                                    }
                                  ],
                                  "children": [
                                    {
                                      "id": "4:93",
                                      "name": "Icon",
                                      "type": "icon",
                                      "visible": true,
                                      "width": 16,
                                      "height": 16,
                                      "x": 12,
                                      "y": 12,
                                      "layoutSelf": {
                                        "align": "auto",
                                        "sizing": {
                                          "horizontal": "fixed",
                                          "vertical": "fixed"
                                        }
                                      },
                                      "children": [
                                        {
                                          "id": "4:94",
                                          "name": "Vector",
                                          "type": "icon",
                                          "visible": true,
                                          "width": 12.02344036102295,
                                          "height": 13.333333969116211,
                                          "x": 2,
                                          "y": 1,
                                          "border": {
                                            "color": "#000000",
                                            "width": 1.6666667461395264,
                                            "style": "solid",
                                            "position": "center"
                                          }
                                        },
                                        {
                                          "id": "4:95",
                                          "name": "Vector",
                                          "type": "icon",
                                          "visible": true,
                                          "width": 4,
                                          "height": 4,
                                          "x": 6,
                                          "y": 6,
                                          "border": {
                                            "color": "#000000",
                                            "width": 1.6666667461395264,
                                            "style": "solid",
                                            "position": "center"
                                          }
                                        }
                                      ]
                                    }
                                  ]
                                },
                                {
                                  "id": "4:96",
                                  "name": "Container",
                                  "type": "container",
                                  "visible": true,
                                  "width": 40,
                                  "height": 40,
                                  "x": 104,
                                  "y": 0,
                                  "layout": {
                                    "mode": "horizontal",
                                    "justifyContent": "center",
                                    "alignItems": "center"
                                  },
                                  "layoutSelf": {
                                    "align": "auto",
                                    "sizing": {
                                      "horizontal": "fixed",
                                      "vertical": "fixed"
                                    }
                                  },
                                  "background": {
                                    "type": "solid",
                                    "value": "#fecdd3"
                                  },
                                  "border": {
                                    "color": "#000000",
                                    "width": 1.600000023841858,
                                    "style": "solid",
                                    "position": "inside"
                                  },
                                  "shadow": [
                                    {
                                      "type": "drop",
                                      "color": "rgba(0, 0, 0, 1.00)",
                                      "offsetX": 2,
                                      "offsetY": 2,
                                      "blur": 0,
                                      "spread": 0
                                    }
                                  ],
                                  "children": [
                                    {
                                      "id": "4:97",
                                      "name": "JD",
                                      "type": "text",
                                      "visible": true,
                                      "width": 22,
                                      "height": 24,
                                      "x": 9,
                                      "y": 8,
                                      "layoutSelf": {
                                        "align": "auto",
                                        "sizing": {
                                          "horizontal": "hug",
                                          "vertical": "hug"
                                        }
                                      },
                                      "background": {
                                        "type": "solid",
                                        "value": "#000000"
                                      },
                                      "text": {
                                        "content": "JD",
                                        "fontFamily": "Inter",
                                        "fontSize": 16,
                                        "fontWeight": 900,
                                        "lineHeight": 24,
                                        "letterSpacing": 0,
                                        "textAlign": "left",
                                        "verticalAlign": "top",
                                        "color": "#000000",
                                        "textDecoration": "none",
                                        "textTransform": "none"
                                      }
                                    }
                                  ]
                                },
                                {
                                  "id": "4:98",
                                  "name": "Button",
                                  "type": "button",
                                  "visible": true,
                                  "width": 117.19999694824219,
                                  "height": 35.20000076293945,
                                  "x": 156,
                                  "y": 2,
                                  "layout": {
                                    "mode": "horizontal",
                                    "alignItems": "center",
                                    "gap": 8,
                                    "padding": {
                                      "top": 8,
                                      "right": 16,
                                      "bottom": 8,
                                      "left": 16
                                    }
                                  },
                                  "layoutSelf": {
                                    "align": "auto",
                                    "sizing": {
                                      "horizontal": "hug",
                                      "vertical": "hug"
                                    }
                                  },
                                  "background": {
                                    "type": "solid",
                                    "value": "#ffffff"
                                  },
                                  "border": {
                                    "color": "#000000",
                                    "width": 1.600000023841858,
                                    "style": "solid",
                                    "position": "inside"
                                  },
                                  "shadow": [
                                    {
                                      "type": "drop",
                                      "color": "rgba(0, 0, 0, 1.00)",
                                      "offsetX": 2,
                                      "offsetY": 2,
                                      "blur": 0,
                                      "spread": 0
                                    }
                                  ],
                                  "children": [
                                    {
                                      "id": "4:99",
                                      "name": "Icon",
                                      "type": "icon",
                                      "visible": true,
                                      "width": 16,
                                      "height": 16,
                                      "x": 18,
                                      "y": 10,
                                      "layoutSelf": {
                                        "align": "auto",
                                        "sizing": {
                                          "horizontal": "fixed",
                                          "vertical": "fixed"
                                        }
                                      },
                                      "children": [
                                        {
                                          "id": "4:100",
                                          "name": "Vector",
                                          "type": "icon",
                                          "visible": true,
                                          "width": 4,
                                          "height": 12,
                                          "x": 2,
                                          "y": 2,
                                          "border": {
                                            "color": "#000000",
                                            "width": 1.6666667461395264,
                                            "style": "solid",
                                            "position": "center"
                                          }
                                        },
                                        {
                                          "id": "4:101",
                                          "name": "Vector",
                                          "type": "icon",
                                          "visible": true,
                                          "width": 3.3333334922790527,
                                          "height": 6.6666669845581055,
                                          "x": 11,
                                          "y": 5,
                                          "border": {
                                            "color": "#000000",
                                            "width": 1.6666667461395264,
                                            "style": "solid",
                                            "position": "center"
                                          }
                                        },
                                        {
                                          "id": "4:102",
                                          "name": "Vector",
                                          "type": "icon",
                                          "visible": true,
                                          "width": 8,
                                          "height": 0,
                                          "x": 6,
                                          "y": 8,
                                          "border": {
                                            "color": "#000000",
                                            "width": 1.6666667461395264,
                                            "style": "solid",
                                            "position": "center"
                                          }
                                        }
                                      ]
                                    },
                                    {
                                      "id": "4:103",
                                      "name": "Logout",
                                      "type": "text",
                                      "visible": true,
                                      "width": 58,
                                      "height": 16,
                                      "x": 42,
                                      "y": 10,
                                      "layoutSelf": {
                                        "align": "auto",
                                        "sizing": {
                                          "horizontal": "hug",
                                          "vertical": "hug"
                                        }
                                      },
                                      "background": {
                                        "type": "solid",
                                        "value": "#000000"
                                      },
                                      "text": {
                                        "content": "Logout",
                                        "fontFamily": "Inter",
                                        "fontSize": 12,
                                        "fontWeight": 800,
                                        "lineHeight": 16,
                                        "letterSpacing": 1.2000000476837158,
                                        "textAlign": "center",
                                        "verticalAlign": "top",
                                        "color": "#000000",
                                        "textDecoration": "none",
                                        "textTransform": "uppercase"
                                      }
                                    }
                                  ]
                                }
                              ]
                            }
                          ]
                        }
                      ]
                    },
                    {
                      "id": "4:104",
                      "name": "DashboardPage",
                      "type": "container",
                      "visible": true,
                      "width": 895.2000122070312,
                      "height": 997.300048828125,
                      "x": 0,
                      "y": 74,
                      "layout": {
                        "mode": "vertical",
                        "padding": {
                          "top": 32,
                          "right": 32,
                          "bottom": 32,
                          "left": 32
                        }
                      },
                      "layoutSelf": {
                        "align": "auto",
                        "sizing": {
                          "horizontal": "fixed",
                          "vertical": "fixed"
                        }
                      },
                      "children": [
                        {
                          "id": "4:105",
                          "name": "Container",
                          "type": "container",
                          "visible": true,
                          "width": 831.2000122070312,
                          "height": 88,
                          "x": 32,
                          "y": 32,
                          "layout": {
                            "mode": "horizontal",
                            "justifyContent": "space-between",
                            "alignItems": "flex-end"
                          },
                          "layoutSelf": {
                            "align": "stretch",
                            "sizing": {
                              "horizontal": "fill",
                              "vertical": "hug"
                            }
                          },
                          "children": [
                            {
                              "id": "4:106",
                              "name": "Container",
                              "type": "container",
                              "visible": true,
                              "width": 391.2749938964844,
                              "height": 88,
                              "x": 0,
                              "y": 0,
                              "layout": {
                                "mode": "vertical"
                              },
                              "layoutSelf": {
                                "align": "auto",
                                "sizing": {
                                  "horizontal": "fixed",
                                  "vertical": "hug"
                                }
                              },
                              "children": [
                                {
                                  "id": "4:107",
                                  "name": "Paragraph",
                                  "type": "container",
                                  "visible": true,
                                  "width": 391.2749938964844,
                                  "height": 16,
                                  "x": 0,
                                  "y": 0,
                                  "layout": {
                                    "mode": "vertical"
                                  },
                                  "layoutSelf": {
                                    "align": "stretch",
                                    "sizing": {
                                      "horizontal": "fill",
                                      "vertical": "hug"
                                    }
                                  },
                                  "children": [
                                    {
                                      "id": "4:108",
                                      "name": "Wednesday, June 3",
                                      "type": "text",
                                      "visible": true,
                                      "width": 145,
                                      "height": 16,
                                      "x": 0,
                                      "y": 0,
                                      "layoutSelf": {
                                        "align": "auto",
                                        "sizing": {
                                          "horizontal": "hug",
                                          "vertical": "hug"
                                        }
                                      },
                                      "background": {
                                        "type": "solid",
                                        "value": "#525252"
                                      },
                                      "text": {
                                        "content": "Wednesday, June 3",
                                        "fontFamily": "Inter",
                                        "fontSize": 12,
                                        "fontWeight": 800,
                                        "lineHeight": 16,
                                        "letterSpacing": 1.2000000476837158,
                                        "textAlign": "left",
                                        "verticalAlign": "top",
                                        "color": "#525252",
                                        "textDecoration": "none",
                                        "textTransform": "uppercase"
                                      }
                                    }
                                  ]
                                },
                                {
                                  "id": "4:109",
                                  "name": "Heading 1",
                                  "type": "container",
                                  "visible": true,
                                  "width": 391.2749938964844,
                                  "height": 48,
                                  "x": 0,
                                  "y": 16,
                                  "layout": {
                                    "mode": "vertical",
                                    "padding": {
                                      "top": 8,
                                      "right": 0,
                                      "bottom": 0,
                                      "left": 0
                                    }
                                  },
                                  "layoutSelf": {
                                    "align": "auto",
                                    "sizing": {
                                      "horizontal": "fixed",
                                      "vertical": "fixed"
                                    }
                                  },
                                  "children": [
                                    {
                                      "id": "4:110",
                                      "name": "Good morning, Admin.",
                                      "type": "text",
                                      "visible": true,
                                      "width": 388,
                                      "height": 40,
                                      "x": 0,
                                      "y": 8,
                                      "layoutSelf": {
                                        "align": "auto",
                                        "sizing": {
                                          "horizontal": "hug",
                                          "vertical": "hug"
                                        }
                                      },
                                      "background": {
                                        "type": "solid",
                                        "value": "#000000"
                                      },
                                      "text": {
                                        "content": "Good morning, Admin.",
                                        "fontFamily": "Inter",
                                        "fontSize": 36,
                                        "fontWeight": 900,
                                        "lineHeight": 39.599998474121094,
                                        "letterSpacing": -0.7200000286102295,
                                        "textAlign": "left",
                                        "verticalAlign": "top",
                                        "color": "#000000",
                                        "textDecoration": "none",
                                        "textTransform": "none"
                                      }
                                    }
                                  ]
                                },
                                {
                                  "id": "4:111",
                                  "name": "Paragraph (margin)",
                                  "type": "container",
                                  "visible": true,
                                  "width": 391.2749938964844,
                                  "height": 24,
                                  "x": 0,
                                  "y": 64,
                                  "layout": {
                                    "mode": "vertical",
                                    "padding": {
                                      "top": 4,
                                      "right": 0,
                                      "bottom": 0,
                                      "left": 0
                                    }
                                  },
                                  "layoutSelf": {
                                    "align": "stretch",
                                    "sizing": {
                                      "horizontal": "fill",
                                      "vertical": "hug"
                                    }
                                  },
                                  "children": [
                                    {
                                      "id": "4:112",
                                      "name": "Paragraph",
                                      "type": "container",
                                      "visible": true,
                                      "width": 391.2749938964844,
                                      "height": 20,
                                      "x": 0,
                                      "y": 4,
                                      "layoutSelf": {
                                        "align": "stretch",
                                        "sizing": {
                                          "horizontal": "fill",
                                          "vertical": "fixed"
                                        }
                                      },
                                      "children": [
                                        {
                                          "id": "4:113",
                                          "name": "You have ",
                                          "type": "text",
                                          "visible": true,
                                          "width": 62,
                                          "height": 20,
                                          "x": 0,
                                          "y": 1,
                                          "background": {
                                            "type": "solid",
                                            "value": "#404040"
                                          },
                                          "text": {
                                            "content": "You have ",
                                            "fontFamily": "Inter",
                                            "fontSize": 14,
                                            "fontWeight": 700,
                                            "lineHeight": 20,
                                            "letterSpacing": 0,
                                            "textAlign": "left",
                                            "verticalAlign": "top",
                                            "color": "#404040",
                                            "textDecoration": "none",
                                            "textTransform": "none"
                                          }
                                        },
                                        {
                                          "id": "4:114",
                                          "name": "Text",
                                          "type": "container",
                                          "visible": true,
                                          "width": 27.912500381469727,
                                          "height": 20,
                                          "x": 66,
                                          "y": 0,
                                          "background": {
                                            "type": "solid",
                                            "value": "#fde047"
                                          },
                                          "border": {
                                            "color": "#000000",
                                            "width": 1.600000023841858,
                                            "style": "solid",
                                            "position": "inside"
                                          },
                                          "children": [
                                            {
                                              "id": "4:115",
                                              "name": "5",
                                              "type": "text",
                                              "visible": true,
                                              "width": 10,
                                              "height": 20,
                                              "x": 10,
                                              "y": 1,
                                              "background": {
                                                "type": "solid",
                                                "value": "#404040"
                                              },
                                              "text": {
                                                "content": "5",
                                                "fontFamily": "Inter",
                                                "fontSize": 14,
                                                "fontWeight": 700,
                                                "lineHeight": 20,
                                                "letterSpacing": 0,
                                                "textAlign": "left",
                                                "verticalAlign": "top",
                                                "color": "#404040",
                                                "textDecoration": "none",
                                                "textTransform": "none"
                                              }
                                            }
                                          ]
                                        },
                                        {
                                          "id": "4:116",
                                          "name": " open tasks today.",
                                          "type": "text",
                                          "visible": true,
                                          "width": 125,
                                          "height": 20,
                                          "x": 94,
                                          "y": 1,
                                          "background": {
                                            "type": "solid",
                                            "value": "#404040"
                                          },
                                          "text": {
                                            "content": " open tasks today.",
                                            "fontFamily": "Inter",
                                            "fontSize": 14,
                                            "fontWeight": 700,
                                            "lineHeight": 20,
                                            "letterSpacing": 0,
                                            "textAlign": "left",
                                            "verticalAlign": "top",
                                            "color": "#404040",
                                            "textDecoration": "none",
                                            "textTransform": "none"
                                          }
                                        }
                                      ]
                                    }
                                  ]
                                }
                              ]
                            },
                            {
                              "id": "4:117",
                              "name": "Button",
                              "type": "button",
                              "visible": true,
                              "width": 169.0625,
                              "height": 44.525001525878906,
                              "x": 662,
                              "y": 43,
                              "layout": {
                                "mode": "horizontal",
                                "alignItems": "center",
                                "gap": 8,
                                "padding": {
                                  "top": 12,
                                  "right": 20,
                                  "bottom": 12,
                                  "left": 20
                                }
                              },
                              "layoutSelf": {
                                "align": "auto",
                                "sizing": {
                                  "horizontal": "hug",
                                  "vertical": "hug"
                                }
                              },
                              "background": {
                                "type": "solid",
                                "value": "#818cf8"
                              },
                              "border": {
                                "color": "#000000",
                                "width": 1.600000023841858,
                                "style": "solid",
                                "position": "inside"
                              },
                              "shadow": [
                                {
                                  "type": "drop",
                                  "color": "rgba(0, 0, 0, 1.00)",
                                  "offsetX": 4,
                                  "offsetY": 4,
                                  "blur": 0,
                                  "spread": 0
                                }
                              ],
                              "children": [
                                {
                                  "id": "4:118",
                                  "name": "Icon",
                                  "type": "icon",
                                  "visible": true,
                                  "width": 16,
                                  "height": 16,
                                  "x": 22,
                                  "y": 14,
                                  "layoutSelf": {
                                    "align": "auto",
                                    "sizing": {
                                      "horizontal": "fixed",
                                      "vertical": "fixed"
                                    }
                                  },
                                  "children": [
                                    {
                                      "id": "4:119",
                                      "name": "Vector",
                                      "type": "icon",
                                      "visible": true,
                                      "width": 9.333333969116211,
                                      "height": 0,
                                      "x": 3,
                                      "y": 8,
                                      "border": {
                                        "color": "#000000",
                                        "width": 2,
                                        "style": "solid",
                                        "position": "center"
                                      }
                                    },
                                    {
                                      "id": "4:120",
                                      "name": "Vector",
                                      "type": "icon",
                                      "visible": true,
                                      "width": 0,
                                      "height": 9.333333969116211,
                                      "x": 8,
                                      "y": 3,
                                      "border": {
                                        "color": "#000000",
                                        "width": 2,
                                        "style": "solid",
                                        "position": "center"
                                      }
                                    }
                                  ]
                                },
                                {
                                  "id": "4:121",
                                  "name": "New Task",
                                  "type": "text",
                                  "visible": true,
                                  "width": 73,
                                  "height": 16,
                                  "x": 46,
                                  "y": 14,
                                  "layoutSelf": {
                                    "align": "auto",
                                    "sizing": {
                                      "horizontal": "hug",
                                      "vertical": "hug"
                                    }
                                  },
                                  "background": {
                                    "type": "solid",
                                    "value": "#000000"
                                  },
                                  "text": {
                                    "content": "New Task",
                                    "fontFamily": "Inter",
                                    "fontSize": 12,
                                    "fontWeight": 800,
                                    "lineHeight": 16,
                                    "letterSpacing": 1.2000000476837158,
                                    "textAlign": "center",
                                    "verticalAlign": "top",
                                    "color": "#000000",
                                    "textDecoration": "none",
                                    "textTransform": "uppercase"
                                  }
                                },
                                {
                                  "id": "4:122",
                                  "name": "Text",
                                  "type": "container",
                                  "visible": true,
                                  "width": 20.86250114440918,
                                  "height": 17.325000762939453,
                                  "x": 127,
                                  "y": 14,
                                  "layoutSelf": {
                                    "align": "auto",
                                    "sizing": {
                                      "horizontal": "fixed",
                                      "vertical": "fixed"
                                    }
                                  },
                                  "background": {
                                    "type": "solid",
                                    "value": "#000000"
                                  },
                                  "children": [
                                    {
                                      "id": "4:123",
                                      "name": "N",
                                      "type": "text",
                                      "visible": true,
                                      "width": 8,
                                      "height": 14,
                                      "x": 6,
                                      "y": 2,
                                      "background": {
                                        "type": "solid",
                                        "value": "#ffffff"
                                      },
                                      "text": {
                                        "content": "N",
                                        "fontFamily": "Inter",
                                        "fontSize": 10,
                                        "fontWeight": 800,
                                        "lineHeight": 13.33329963684082,
                                        "letterSpacing": 1.2000000476837158,
                                        "textAlign": "center",
                                        "verticalAlign": "top",
                                        "color": "#ffffff",
                                        "textDecoration": "none",
                                        "textTransform": "uppercase"
                                      }
                                    }
                                  ]
                                }
                              ]
                            }
                          ]
                        },
                        {
                          "id": "4:124",
                          "name": "Container (margin)",
                          "type": "container",
                          "visible": true,
                          "width": 831.2000122070312,
                          "height": 79.98750305175781,
                          "x": 32,
                          "y": 120,
                          "layout": {
                            "mode": "vertical",
                            "padding": {
                              "top": 32,
                              "right": 0,
                              "bottom": 0,
                              "left": 0
                            }
                          },
                          "layoutSelf": {
                            "align": "stretch",
                            "sizing": {
                              "horizontal": "fill",
                              "vertical": "hug"
                            }
                          },
                          "children": [
                            {
                              "id": "4:125",
                              "name": "Container",
                              "type": "container",
                              "visible": true,
                              "width": 831.2000122070312,
                              "height": 47.98749923706055,
                              "x": 0,
                              "y": 32,
                              "layout": {
                                "mode": "vertical"
                              },
                              "layoutSelf": {
                                "align": "stretch",
                                "sizing": {
                                  "horizontal": "fill",
                                  "vertical": "hug"
                                }
                              },
                              "children": [
                                {
                                  "id": "4:126",
                                  "name": "Container",
                                  "type": "container",
                                  "visible": true,
                                  "width": 831.2000122070312,
                                  "height": 15.987500190734863,
                                  "x": 0,
                                  "y": 0,
                                  "layout": {
                                    "mode": "horizontal",
                                    "justifyContent": "space-between",
                                    "alignItems": "center"
                                  },
                                  "layoutSelf": {
                                    "align": "stretch",
                                    "sizing": {
                                      "horizontal": "fill",
                                      "vertical": "hug"
                                    }
                                  },
                                  "children": [
                                    {
                                      "id": "4:127",
                                      "name": "Paragraph",
                                      "type": "container",
                                      "visible": true,
                                      "width": 147.9250030517578,
                                      "height": 15.987500190734863,
                                      "x": 0,
                                      "y": 0,
                                      "layoutSelf": {
                                        "align": "auto",
                                        "sizing": {
                                          "horizontal": "fixed",
                                          "vertical": "fixed"
                                        }
                                      },
                                      "children": [
                                        {
                                          "id": "4:128",
                                          "name": "Weekly Momentum",
                                          "type": "text",
                                          "visible": true,
                                          "width": 146,
                                          "height": 16,
                                          "x": 0,
                                          "y": 0,
                                          "background": {
                                            "type": "solid",
                                            "value": "#000000"
                                          },
                                          "text": {
                                            "content": "Weekly Momentum",
                                            "fontFamily": "Inter",
                                            "fontSize": 12,
                                            "fontWeight": 800,
                                            "lineHeight": 16,
                                            "letterSpacing": 1.2000000476837158,
                                            "textAlign": "left",
                                            "verticalAlign": "top",
                                            "color": "#000000",
                                            "textDecoration": "none",
                                            "textTransform": "uppercase"
                                          }
                                        }
                                      ]
                                    },
                                    {
                                      "id": "4:129",
                                      "name": "Paragraph",
                                      "type": "container",
                                      "visible": true,
                                      "width": 81.0250015258789,
                                      "height": 15.987500190734863,
                                      "x": 750,
                                      "y": 0,
                                      "layoutSelf": {
                                        "align": "auto",
                                        "sizing": {
                                          "horizontal": "fixed",
                                          "vertical": "fixed"
                                        }
                                      },
                                      "children": [
                                        {
                                          "id": "4:130",
                                          "name": "17% / 100%",
                                          "type": "text",
                                          "visible": true,
                                          "width": 78,
                                          "height": 16,
                                          "x": 0,
                                          "y": 0,
                                          "background": {
                                            "type": "solid",
                                            "value": "#000000"
                                          },
                                          "text": {
                                            "content": "17% / 100%",
                                            "fontFamily": "Inter",
                                            "fontSize": 12,
                                            "fontWeight": 800,
                                            "lineHeight": 16,
                                            "letterSpacing": 1.2000000476837158,
                                            "textAlign": "left",
                                            "verticalAlign": "top",
                                            "color": "#000000",
                                            "textDecoration": "none",
                                            "textTransform": "uppercase"
                                          }
                                        }
                                      ]
                                    }
                                  ]
                                },
                                {
                                  "id": "4:131",
                                  "name": "Container (margin)",
                                  "type": "container",
                                  "visible": true,
                                  "width": 831.2000122070312,
                                  "height": 32,
                                  "x": 0,
                                  "y": 16,
                                  "layout": {
                                    "mode": "vertical",
                                    "padding": {
                                      "top": 8,
                                      "right": 0,
                                      "bottom": 0,
                                      "left": 0
                                    }
                                  },
                                  "layoutSelf": {
                                    "align": "stretch",
                                    "sizing": {
                                      "horizontal": "fill",
                                      "vertical": "hug"
                                    }
                                  },
                                  "children": [
                                    {
                                      "id": "4:132",
                                      "name": "Container",
                                      "type": "container",
                                      "visible": true,
                                      "width": 831.2000122070312,
                                      "height": 24,
                                      "x": 0,
                                      "y": 8,
                                      "layout": {
                                        "mode": "vertical"
                                      },
                                      "layoutSelf": {
                                        "align": "auto",
                                        "sizing": {
                                          "horizontal": "fixed",
                                          "vertical": "fixed"
                                        }
                                      },
                                      "background": {
                                        "type": "solid",
                                        "value": "#ffffff"
                                      },
                                      "border": {
                                        "color": "#000000",
                                        "width": 1.600000023841858,
                                        "style": "solid",
                                        "position": "inside"
                                      },
                                      "shadow": [
                                        {
                                          "type": "drop",
                                          "color": "rgba(0, 0, 0, 1.00)",
                                          "offsetX": 4,
                                          "offsetY": 4,
                                          "blur": 0,
                                          "spread": 0
                                        }
                                      ],
                                      "children": [
                                        {
                                          "id": "4:133",
                                          "name": "Container",
                                          "type": "unknown",
                                          "visible": true,
                                          "width": 140.75,
                                          "height": 20.80000114440918,
                                          "x": 2,
                                          "y": 2,
                                          "layoutSelf": {
                                            "align": "auto",
                                            "sizing": {
                                              "horizontal": "fixed",
                                              "vertical": "fixed"
                                            }
                                          },
                                          "background": {
                                            "type": "solid",
                                            "value": "#a7f3d0"
                                          },
                                          "border": {
                                            "color": "#000000",
                                            "width": 1,
                                            "style": "solid",
                                            "position": "inside"
                                          }
                                        },
                                        {
                                          "id": "4:134",
                                          "name": "Container",
                                          "type": "container",
                                          "visible": true,
                                          "width": 828,
                                          "height": 20.80000114440918,
                                          "x": 2,
                                          "y": 2,
                                          "layout": {
                                            "mode": "horizontal",
                                            "alignItems": "center",
                                            "padding": {
                                              "top": 0,
                                              "right": 12,
                                              "bottom": 0,
                                              "left": 12
                                            }
                                          },
                                          "layoutSelf": {
                                            "align": "auto",
                                            "sizing": {
                                              "horizontal": "fixed",
                                              "vertical": "fixed"
                                            }
                                          },
                                          "children": [
                                            {
                                              "id": "4:135",
                                              "name": "Text",
                                              "type": "container",
                                              "visible": true,
                                              "width": 84.4000015258789,
                                              "height": 15,
                                              "x": 12,
                                              "y": 3,
                                              "layoutSelf": {
                                                "align": "auto",
                                                "sizing": {
                                                  "horizontal": "fixed",
                                                  "vertical": "fixed"
                                                }
                                              },
                                              "children": [
                                                {
                                                  "id": "4:136",
                                                  "name": "Keep Going →",
                                                  "type": "text",
                                                  "visible": true,
                                                  "width": 85,
                                                  "height": 15,
                                                  "x": 0,
                                                  "y": 0,
                                                  "background": {
                                                    "type": "solid",
                                                    "value": "#000000"
                                                  },
                                                  "text": {
                                                    "content": "Keep Going →",
                                                    "fontFamily": "Inter",
                                                    "fontSize": 10,
                                                    "fontWeight": 800,
                                                    "lineHeight": 15,
                                                    "letterSpacing": 1,
                                                    "textAlign": "left",
                                                    "verticalAlign": "top",
                                                    "color": "#000000",
                                                    "textDecoration": "none",
                                                    "textTransform": "uppercase"
                                                  }
                                                }
                                              ]
                                            }
                                          ]
                                        }
                                      ]
                                    }
                                  ]
                                }
                              ]
                            }
                          ]
                        },
                        {
                          "id": "4:137",
                          "name": "Container (margin)",
                          "type": "container",
                          "visible": true,
                          "width": 831.2000122070312,
                          "height": 195.78750610351562,
                          "x": 32,
                          "y": 200,
                          "layout": {
                            "mode": "vertical",
                            "padding": {
                              "top": 32,
                              "right": 0,
                              "bottom": 0,
                              "left": 0
                            }
                          },
                          "layoutSelf": {
                            "align": "stretch",
                            "sizing": {
                              "horizontal": "fill",
                              "vertical": "hug"
                            }
                          },
                          "children": [
                            {
                              "id": "4:138",
                              "name": "Container",
                              "type": "container",
                              "visible": true,
                              "width": 831.2000122070312,
                              "height": 163.78750610351562,
                              "x": 0,
                              "y": 32,
                              "layoutSelf": {
                                "align": "stretch",
                                "sizing": {
                                  "horizontal": "fill",
                                  "vertical": "fixed"
                                }
                              },
                              "children": [
                                {
                                  "id": "4:139",
                                  "name": "Container",
                                  "type": "container",
                                  "visible": true,
                                  "width": 192.8000030517578,
                                  "height": 163.8000030517578,
                                  "x": 0,
                                  "y": 0,
                                  "layout": {
                                    "mode": "vertical",
                                    "padding": {
                                      "top": 20,
                                      "right": 20,
                                      "bottom": 20,
                                      "left": 20
                                    }
                                  },
                                  "layoutSelf": {
                                    "sizing": {
                                      "horizontal": "fixed",
                                      "vertical": "hug"
                                    }
                                  },
                                  "background": {
                                    "type": "solid",
                                    "value": "#ffffff"
                                  },
                                  "border": {
                                    "color": "#000000",
                                    "width": 1.600000023841858,
                                    "style": "solid",
                                    "position": "inside"
                                  },
                                  "shadow": [
                                    {
                                      "type": "drop",
                                      "color": "rgba(0, 0, 0, 1.00)",
                                      "offsetX": 4,
                                      "offsetY": 4,
                                      "blur": 0,
                                      "spread": 0
                                    }
                                  ],
                                  "children": [
                                    {
                                      "id": "4:140",
                                      "name": "Paragraph",
                                      "type": "container",
                                      "visible": true,
                                      "width": 149.60000610351562,
                                      "height": 16,
                                      "x": 22,
                                      "y": 22,
                                      "layout": {
                                        "mode": "vertical"
                                      },
                                      "layoutSelf": {
                                        "align": "stretch",
                                        "sizing": {
                                          "horizontal": "fill",
                                          "vertical": "hug"
                                        }
                                      },
                                      "children": [
                                        {
                                          "id": "4:141",
                                          "name": "Total",
                                          "type": "text",
                                          "visible": true,
                                          "width": 45,
                                          "height": 16,
                                          "x": 0,
                                          "y": 0,
                                          "layoutSelf": {
                                            "align": "auto",
                                            "sizing": {
                                              "horizontal": "hug",
                                              "vertical": "hug"
                                            }
                                          },
                                          "background": {
                                            "type": "solid",
                                            "value": "#000000"
                                          },
                                          "text": {
                                            "content": "Total",
                                            "fontFamily": "Inter",
                                            "fontSize": 12,
                                            "fontWeight": 800,
                                            "lineHeight": 16,
                                            "letterSpacing": 1.2000000476837158,
                                            "textAlign": "left",
                                            "verticalAlign": "top",
                                            "color": "#000000",
                                            "textDecoration": "none",
                                            "textTransform": "uppercase"
                                          }
                                        }
                                      ]
                                    },
                                    {
                                      "id": "4:142",
                                      "name": "Paragraph",
                                      "type": "container",
                                      "visible": true,
                                      "width": 149.60000610351562,
                                      "height": 60,
                                      "x": 22,
                                      "y": 38,
                                      "layout": {
                                        "mode": "vertical",
                                        "padding": {
                                          "top": 12,
                                          "right": 0,
                                          "bottom": 0,
                                          "left": 0
                                        }
                                      },
                                      "layoutSelf": {
                                        "align": "auto",
                                        "sizing": {
                                          "horizontal": "fixed",
                                          "vertical": "fixed"
                                        }
                                      },
                                      "children": [
                                        {
                                          "id": "4:143",
                                          "name": "6",
                                          "type": "text",
                                          "visible": true,
                                          "width": 33,
                                          "height": 48,
                                          "x": 0,
                                          "y": 12,
                                          "layoutSelf": {
                                            "align": "auto",
                                            "sizing": {
                                              "horizontal": "hug",
                                              "vertical": "hug"
                                            }
                                          },
                                          "background": {
                                            "type": "solid",
                                            "value": "#000000"
                                          },
                                          "text": {
                                            "content": "6",
                                            "fontFamily": "Inter",
                                            "fontSize": 48,
                                            "fontWeight": 900,
                                            "lineHeight": 48,
                                            "letterSpacing": 0,
                                            "textAlign": "left",
                                            "verticalAlign": "top",
                                            "color": "#000000",
                                            "textDecoration": "none",
                                            "textTransform": "none"
                                          }
                                        }
                                      ]
                                    },
                                    {
                                      "id": "4:144",
                                      "name": "Container (margin)",
                                      "type": "container",
                                      "visible": true,
                                      "width": 149.60000610351562,
                                      "height": 44.599998474121094,
                                      "x": 22,
                                      "y": 98,
                                      "layout": {
                                        "mode": "vertical",
                                        "alignItems": "center",
                                        "padding": {
                                          "top": 16,
                                          "right": 0,
                                          "bottom": 0,
                                          "left": 0
                                        }
                                      },
                                      "layoutSelf": {
                                        "align": "stretch",
                                        "sizing": {
                                          "horizontal": "fill",
                                          "vertical": "hug"
                                        }
                                      },
                                      "children": [
                                        {
                                          "id": "4:145",
                                          "name": "Container",
                                          "type": "container",
                                          "visible": true,
                                          "width": 149.60000610351562,
                                          "height": 28.600000381469727,
                                          "x": 0,
                                          "y": 16,
                                          "layout": {
                                            "mode": "horizontal",
                                            "justifyContent": "space-between",
                                            "alignItems": "center",
                                            "padding": {
                                              "top": 12,
                                              "right": 0,
                                              "bottom": 0,
                                              "left": 0
                                            }
                                          },
                                          "layoutSelf": {
                                            "align": "stretch",
                                            "sizing": {
                                              "horizontal": "fill",
                                              "vertical": "hug"
                                            }
                                          },
                                          "border": {
                                            "color": "#000000",
                                            "width": 1,
                                            "style": "solid",
                                            "position": "inside"
                                          },
                                          "children": [
                                            {
                                              "id": "4:146",
                                              "name": "Text",
                                              "type": "container",
                                              "visible": true,
                                              "width": 65.07500457763672,
                                              "height": 15,
                                              "x": 0,
                                              "y": 14,
                                              "layoutSelf": {
                                                "align": "auto",
                                                "sizing": {
                                                  "horizontal": "fixed",
                                                  "vertical": "fixed"
                                                }
                                              },
                                              "children": [
                                                {
                                                  "id": "4:147",
                                                  "name": "This Week",
                                                  "type": "text",
                                                  "visible": true,
                                                  "width": 64,
                                                  "height": 15,
                                                  "x": 0,
                                                  "y": 0,
                                                  "background": {
                                                    "type": "solid",
                                                    "value": "#000000"
                                                  },
                                                  "text": {
                                                    "content": "This Week",
                                                    "fontFamily": "Inter",
                                                    "fontSize": 10,
                                                    "fontWeight": 800,
                                                    "lineHeight": 15,
                                                    "letterSpacing": 1,
                                                    "textAlign": "left",
                                                    "verticalAlign": "top",
                                                    "color": "#000000",
                                                    "textDecoration": "none",
                                                    "textTransform": "uppercase"
                                                  }
                                                }
                                              ]
                                            },
                                            {
                                              "id": "4:148",
                                              "name": "Text",
                                              "type": "container",
                                              "visible": true,
                                              "width": 40.01250076293945,
                                              "height": 15,
                                              "x": 110,
                                              "y": 14,
                                              "layoutSelf": {
                                                "align": "auto",
                                                "sizing": {
                                                  "horizontal": "fixed",
                                                  "vertical": "fixed"
                                                }
                                              },
                                              "children": [
                                                {
                                                  "id": "4:149",
                                                  "name": "↑ +12%",
                                                  "type": "text",
                                                  "visible": true,
                                                  "width": 39,
                                                  "height": 15,
                                                  "x": 0,
                                                  "y": 0,
                                                  "background": {
                                                    "type": "solid",
                                                    "value": "#000000"
                                                  },
                                                  "text": {
                                                    "content": "↑ +12%",
                                                    "fontFamily": "Inter",
                                                    "fontSize": 10,
                                                    "fontWeight": 900,
                                                    "lineHeight": 15,
                                                    "letterSpacing": 0,
                                                    "textAlign": "left",
                                                    "verticalAlign": "top",
                                                    "color": "#000000",
                                                    "textDecoration": "none",
                                                    "textTransform": "none"
                                                  }
                                                }
                                              ]
                                            }
                                          ]
                                        }
                                      ]
                                    }
                                  ]
                                },
                                {
                                  "id": "4:150",
                                  "name": "Container",
                                  "type": "container",
                                  "visible": true,
                                  "width": 192.8000030517578,
                                  "height": 163.8000030517578,
                                  "x": 213,
                                  "y": 0,
                                  "layout": {
                                    "mode": "vertical",
                                    "padding": {
                                      "top": 20,
                                      "right": 20,
                                      "bottom": 20,
                                      "left": 20
                                    }
                                  },
                                  "layoutSelf": {
                                    "sizing": {
                                      "horizontal": "fixed",
                                      "vertical": "hug"
                                    }
                                  },
                                  "background": {
                                    "type": "solid",
                                    "value": "#a7f3d0"
                                  },
                                  "border": {
                                    "color": "#000000",
                                    "width": 1.600000023841858,
                                    "style": "solid",
                                    "position": "inside"
                                  },
                                  "shadow": [
                                    {
                                      "type": "drop",
                                      "color": "rgba(0, 0, 0, 1.00)",
                                      "offsetX": 4,
                                      "offsetY": 4,
                                      "blur": 0,
                                      "spread": 0
                                    }
                                  ],
                                  "children": [
                                    {
                                      "id": "4:151",
                                      "name": "Paragraph",
                                      "type": "container",
                                      "visible": true,
                                      "width": 149.60000610351562,
                                      "height": 16,
                                      "x": 22,
                                      "y": 22,
                                      "layout": {
                                        "mode": "vertical"
                                      },
                                      "layoutSelf": {
                                        "align": "stretch",
                                        "sizing": {
                                          "horizontal": "fill",
                                          "vertical": "hug"
                                        }
                                      },
                                      "children": [
                                        {
                                          "id": "4:152",
                                          "name": "Completed",
                                          "type": "text",
                                          "visible": true,
                                          "width": 86,
                                          "height": 16,
                                          "x": 0,
                                          "y": 0,
                                          "layoutSelf": {
                                            "align": "auto",
                                            "sizing": {
                                              "horizontal": "hug",
                                              "vertical": "hug"
                                            }
                                          },
                                          "background": {
                                            "type": "solid",
                                            "value": "#000000"
                                          },
                                          "text": {
                                            "content": "Completed",
                                            "fontFamily": "Inter",
                                            "fontSize": 12,
                                            "fontWeight": 800,
                                            "lineHeight": 16,
                                            "letterSpacing": 1.2000000476837158,
                                            "textAlign": "left",
                                            "verticalAlign": "top",
                                            "color": "#000000",
                                            "textDecoration": "none",
                                            "textTransform": "uppercase"
                                          }
                                        }
                                      ]
                                    },
                                    {
                                      "id": "4:153",
                                      "name": "Paragraph",
                                      "type": "container",
                                      "visible": true,
                                      "width": 149.60000610351562,
                                      "height": 60,
                                      "x": 22,
                                      "y": 38,
                                      "layout": {
                                        "mode": "vertical",
                                        "padding": {
                                          "top": 12,
                                          "right": 0,
                                          "bottom": 0,
                                          "left": 0
                                        }
                                      },
                                      "layoutSelf": {
                                        "align": "auto",
                                        "sizing": {
                                          "horizontal": "fixed",
                                          "vertical": "fixed"
                                        }
                                      },
                                      "children": [
                                        {
                                          "id": "4:154",
                                          "name": "1",
                                          "type": "text",
                                          "visible": true,
                                          "width": 25,
                                          "height": 48,
                                          "x": 0,
                                          "y": 12,
                                          "layoutSelf": {
                                            "align": "auto",
                                            "sizing": {
                                              "horizontal": "hug",
                                              "vertical": "hug"
                                            }
                                          },
                                          "background": {
                                            "type": "solid",
                                            "value": "#000000"
                                          },
                                          "text": {
                                            "content": "1",
                                            "fontFamily": "Inter",
                                            "fontSize": 48,
                                            "fontWeight": 900,
                                            "lineHeight": 48,
                                            "letterSpacing": 0,
                                            "textAlign": "left",
                                            "verticalAlign": "top",
                                            "color": "#000000",
                                            "textDecoration": "none",
                                            "textTransform": "none"
                                          }
                                        }
                                      ]
                                    },
                                    {
                                      "id": "4:155",
                                      "name": "Container (margin)",
                                      "type": "container",
                                      "visible": true,
                                      "width": 149.60000610351562,
                                      "height": 44.599998474121094,
                                      "x": 22,
                                      "y": 98,
                                      "layout": {
                                        "mode": "vertical",
                                        "alignItems": "center",
                                        "padding": {
                                          "top": 16,
                                          "right": 0,
                                          "bottom": 0,
                                          "left": 0
                                        }
                                      },
                                      "layoutSelf": {
                                        "align": "stretch",
                                        "sizing": {
                                          "horizontal": "fill",
                                          "vertical": "hug"
                                        }
                                      },
                                      "children": [
                                        {
                                          "id": "4:156",
                                          "name": "Container",
                                          "type": "container",
                                          "visible": true,
                                          "width": 149.60000610351562,
                                          "height": 28.600000381469727,
                                          "x": 0,
                                          "y": 16,
                                          "layout": {
                                            "mode": "horizontal",
                                            "justifyContent": "space-between",
                                            "alignItems": "center",
                                            "padding": {
                                              "top": 12,
                                              "right": 0,
                                              "bottom": 0,
                                              "left": 0
                                            }
                                          },
                                          "layoutSelf": {
                                            "align": "stretch",
                                            "sizing": {
                                              "horizontal": "fill",
                                              "vertical": "hug"
                                            }
                                          },
                                          "border": {
                                            "color": "#000000",
                                            "width": 1,
                                            "style": "solid",
                                            "position": "inside"
                                          },
                                          "children": [
                                            {
                                              "id": "4:157",
                                              "name": "Text",
                                              "type": "container",
                                              "visible": true,
                                              "width": 65.07500457763672,
                                              "height": 15,
                                              "x": 0,
                                              "y": 14,
                                              "layoutSelf": {
                                                "align": "auto",
                                                "sizing": {
                                                  "horizontal": "fixed",
                                                  "vertical": "fixed"
                                                }
                                              },
                                              "children": [
                                                {
                                                  "id": "4:158",
                                                  "name": "This Week",
                                                  "type": "text",
                                                  "visible": true,
                                                  "width": 64,
                                                  "height": 15,
                                                  "x": 0,
                                                  "y": 0,
                                                  "background": {
                                                    "type": "solid",
                                                    "value": "#000000"
                                                  },
                                                  "text": {
                                                    "content": "This Week",
                                                    "fontFamily": "Inter",
                                                    "fontSize": 10,
                                                    "fontWeight": 800,
                                                    "lineHeight": 15,
                                                    "letterSpacing": 1,
                                                    "textAlign": "left",
                                                    "verticalAlign": "top",
                                                    "color": "#000000",
                                                    "textDecoration": "none",
                                                    "textTransform": "uppercase"
                                                  }
                                                }
                                              ]
                                            },
                                            {
                                              "id": "4:159",
                                              "name": "Text",
                                              "type": "container",
                                              "visible": true,
                                              "width": 40.01250076293945,
                                              "height": 15,
                                              "x": 110,
                                              "y": 14,
                                              "layoutSelf": {
                                                "align": "auto",
                                                "sizing": {
                                                  "horizontal": "fixed",
                                                  "vertical": "fixed"
                                                }
                                              },
                                              "children": [
                                                {
                                                  "id": "4:160",
                                                  "name": "↑ +12%",
                                                  "type": "text",
                                                  "visible": true,
                                                  "width": 39,
                                                  "height": 15,
                                                  "x": 0,
                                                  "y": 0,
                                                  "background": {
                                                    "type": "solid",
                                                    "value": "#000000"
                                                  },
                                                  "text": {
                                                    "content": "↑ +12%",
                                                    "fontFamily": "Inter",
                                                    "fontSize": 10,
                                                    "fontWeight": 900,
                                                    "lineHeight": 15,
                                                    "letterSpacing": 0,
                                                    "textAlign": "left",
                                                    "verticalAlign": "top",
                                                    "color": "#000000",
                                                    "textDecoration": "none",
                                                    "textTransform": "none"
                                                  }
                                                }
                                              ]
                                            }
                                          ]
                                        }
                                      ]
                                    }
                                  ]
                                },
                                {
                                  "id": "4:161",
                                  "name": "Container",
                                  "type": "container",
                                  "visible": true,
                                  "width": 192.8000030517578,
                                  "height": 163.8000030517578,
                                  "x": 426,
                                  "y": 0,
                                  "layout": {
                                    "mode": "vertical",
                                    "padding": {
                                      "top": 20,
                                      "right": 20,
                                      "bottom": 20,
                                      "left": 20
                                    }
                                  },
                                  "layoutSelf": {
                                    "sizing": {
                                      "horizontal": "fixed",
                                      "vertical": "hug"
                                    }
                                  },
                                  "background": {
                                    "type": "solid",
                                    "value": "#fde047"
                                  },
                                  "border": {
                                    "color": "#000000",
                                    "width": 1.600000023841858,
                                    "style": "solid",
                                    "position": "inside"
                                  },
                                  "shadow": [
                                    {
                                      "type": "drop",
                                      "color": "rgba(0, 0, 0, 1.00)",
                                      "offsetX": 4,
                                      "offsetY": 4,
                                      "blur": 0,
                                      "spread": 0
                                    }
                                  ],
                                  "children": [
                                    {
                                      "id": "4:162",
                                      "name": "Paragraph",
                                      "type": "container",
                                      "visible": true,
                                      "width": 149.60000610351562,
                                      "height": 16,
                                      "x": 22,
                                      "y": 22,
                                      "layout": {
                                        "mode": "vertical"
                                      },
                                      "layoutSelf": {
                                        "align": "stretch",
                                        "sizing": {
                                          "horizontal": "fill",
                                          "vertical": "hug"
                                        }
                                      },
                                      "children": [
                                        {
                                          "id": "4:163",
                                          "name": "In Progress",
                                          "type": "text",
                                          "visible": true,
                                          "width": 93,
                                          "height": 16,
                                          "x": 0,
                                          "y": 0,
                                          "layoutSelf": {
                                            "align": "auto",
                                            "sizing": {
                                              "horizontal": "hug",
                                              "vertical": "hug"
                                            }
                                          },
                                          "background": {
                                            "type": "solid",
                                            "value": "#000000"
                                          },
                                          "text": {
                                            "content": "In Progress",
                                            "fontFamily": "Inter",
                                            "fontSize": 12,
                                            "fontWeight": 800,
                                            "lineHeight": 16,
                                            "letterSpacing": 1.2000000476837158,
                                            "textAlign": "left",
                                            "verticalAlign": "top",
                                            "color": "#000000",
                                            "textDecoration": "none",
                                            "textTransform": "uppercase"
                                          }
                                        }
                                      ]
                                    },
                                    {
                                      "id": "4:164",
                                      "name": "Paragraph",
                                      "type": "container",
                                      "visible": true,
                                      "width": 149.60000610351562,
                                      "height": 60,
                                      "x": 22,
                                      "y": 38,
                                      "layout": {
                                        "mode": "vertical",
                                        "padding": {
                                          "top": 12,
                                          "right": 0,
                                          "bottom": 0,
                                          "left": 0
                                        }
                                      },
                                      "layoutSelf": {
                                        "align": "auto",
                                        "sizing": {
                                          "horizontal": "fixed",
                                          "vertical": "fixed"
                                        }
                                      },
                                      "children": [
                                        {
                                          "id": "4:165",
                                          "name": "2",
                                          "type": "text",
                                          "visible": true,
                                          "width": 32,
                                          "height": 48,
                                          "x": 0,
                                          "y": 12,
                                          "layoutSelf": {
                                            "align": "auto",
                                            "sizing": {
                                              "horizontal": "hug",
                                              "vertical": "hug"
                                            }
                                          },
                                          "background": {
                                            "type": "solid",
                                            "value": "#000000"
                                          },
                                          "text": {
                                            "content": "2",
                                            "fontFamily": "Inter",
                                            "fontSize": 48,
                                            "fontWeight": 900,
                                            "lineHeight": 48,
                                            "letterSpacing": 0,
                                            "textAlign": "left",
                                            "verticalAlign": "top",
                                            "color": "#000000",
                                            "textDecoration": "none",
                                            "textTransform": "none"
                                          }
                                        }
                                      ]
                                    },
                                    {
                                      "id": "4:166",
                                      "name": "Container (margin)",
                                      "type": "container",
                                      "visible": true,
                                      "width": 149.60000610351562,
                                      "height": 44.599998474121094,
                                      "x": 22,
                                      "y": 98,
                                      "layout": {
                                        "mode": "vertical",
                                        "alignItems": "center",
                                        "padding": {
                                          "top": 16,
                                          "right": 0,
                                          "bottom": 0,
                                          "left": 0
                                        }
                                      },
                                      "layoutSelf": {
                                        "align": "stretch",
                                        "sizing": {
                                          "horizontal": "fill",
                                          "vertical": "hug"
                                        }
                                      },
                                      "children": [
                                        {
                                          "id": "4:167",
                                          "name": "Container",
                                          "type": "container",
                                          "visible": true,
                                          "width": 149.60000610351562,
                                          "height": 28.600000381469727,
                                          "x": 0,
                                          "y": 16,
                                          "layout": {
                                            "mode": "horizontal",
                                            "justifyContent": "space-between",
                                            "alignItems": "center",
                                            "padding": {
                                              "top": 12,
                                              "right": 0,
                                              "bottom": 0,
                                              "left": 0
                                            }
                                          },
                                          "layoutSelf": {
                                            "align": "stretch",
                                            "sizing": {
                                              "horizontal": "fill",
                                              "vertical": "hug"
                                            }
                                          },
                                          "border": {
                                            "color": "#000000",
                                            "width": 1,
                                            "style": "solid",
                                            "position": "inside"
                                          },
                                          "children": [
                                            {
                                              "id": "4:168",
                                              "name": "Text",
                                              "type": "container",
                                              "visible": true,
                                              "width": 65.07500457763672,
                                              "height": 15,
                                              "x": 0,
                                              "y": 14,
                                              "layoutSelf": {
                                                "align": "auto",
                                                "sizing": {
                                                  "horizontal": "fixed",
                                                  "vertical": "fixed"
                                                }
                                              },
                                              "children": [
                                                {
                                                  "id": "4:169",
                                                  "name": "This Week",
                                                  "type": "text",
                                                  "visible": true,
                                                  "width": 64,
                                                  "height": 15,
                                                  "x": 0,
                                                  "y": 0,
                                                  "background": {
                                                    "type": "solid",
                                                    "value": "#000000"
                                                  },
                                                  "text": {
                                                    "content": "This Week",
                                                    "fontFamily": "Inter",
                                                    "fontSize": 10,
                                                    "fontWeight": 800,
                                                    "lineHeight": 15,
                                                    "letterSpacing": 1,
                                                    "textAlign": "left",
                                                    "verticalAlign": "top",
                                                    "color": "#000000",
                                                    "textDecoration": "none",
                                                    "textTransform": "uppercase"
                                                  }
                                                }
                                              ]
                                            },
                                            {
                                              "id": "4:170",
                                              "name": "Text",
                                              "type": "container",
                                              "visible": true,
                                              "width": 40.01250076293945,
                                              "height": 15,
                                              "x": 110,
                                              "y": 14,
                                              "layoutSelf": {
                                                "align": "auto",
                                                "sizing": {
                                                  "horizontal": "fixed",
                                                  "vertical": "fixed"
                                                }
                                              },
                                              "children": [
                                                {
                                                  "id": "4:171",
                                                  "name": "↑ +12%",
                                                  "type": "text",
                                                  "visible": true,
                                                  "width": 39,
                                                  "height": 15,
                                                  "x": 0,
                                                  "y": 0,
                                                  "background": {
                                                    "type": "solid",
                                                    "value": "#000000"
                                                  },
                                                  "text": {
                                                    "content": "↑ +12%",
                                                    "fontFamily": "Inter",
                                                    "fontSize": 10,
                                                    "fontWeight": 900,
                                                    "lineHeight": 15,
                                                    "letterSpacing": 0,
                                                    "textAlign": "left",
                                                    "verticalAlign": "top",
                                                    "color": "#000000",
                                                    "textDecoration": "none",
                                                    "textTransform": "none"
                                                  }
                                                }
                                              ]
                                            }
                                          ]
                                        }
                                      ]
                                    }
                                  ]
                                },
                                {
                                  "id": "4:172",
                                  "name": "Container",
                                  "type": "container",
                                  "visible": true,
                                  "width": 192.8000030517578,
                                  "height": 163.8000030517578,
                                  "x": 638,
                                  "y": 0,
                                  "layout": {
                                    "mode": "vertical",
                                    "padding": {
                                      "top": 20,
                                      "right": 20,
                                      "bottom": 20,
                                      "left": 20
                                    }
                                  },
                                  "layoutSelf": {
                                    "sizing": {
                                      "horizontal": "fixed",
                                      "vertical": "hug"
                                    }
                                  },
                                  "background": {
                                    "type": "solid",
                                    "value": "#fecdd3"
                                  },
                                  "border": {
                                    "color": "#000000",
                                    "width": 1.600000023841858,
                                    "style": "solid",
                                    "position": "inside"
                                  },
                                  "shadow": [
                                    {
                                      "type": "drop",
                                      "color": "rgba(0, 0, 0, 1.00)",
                                      "offsetX": 4,
                                      "offsetY": 4,
                                      "blur": 0,
                                      "spread": 0
                                    }
                                  ],
                                  "children": [
                                    {
                                      "id": "4:173",
                                      "name": "Paragraph",
                                      "type": "container",
                                      "visible": true,
                                      "width": 149.60000610351562,
                                      "height": 16,
                                      "x": 22,
                                      "y": 22,
                                      "layout": {
                                        "mode": "vertical"
                                      },
                                      "layoutSelf": {
                                        "align": "stretch",
                                        "sizing": {
                                          "horizontal": "fill",
                                          "vertical": "hug"
                                        }
                                      },
                                      "children": [
                                        {
                                          "id": "4:174",
                                          "name": "Overdue",
                                          "type": "text",
                                          "visible": true,
                                          "width": 66,
                                          "height": 16,
                                          "x": 0,
                                          "y": 0,
                                          "layoutSelf": {
                                            "align": "auto",
                                            "sizing": {
                                              "horizontal": "hug",
                                              "vertical": "hug"
                                            }
                                          },
                                          "background": {
                                            "type": "solid",
                                            "value": "#000000"
                                          },
                                          "text": {
                                            "content": "Overdue",
                                            "fontFamily": "Inter",
                                            "fontSize": 12,
                                            "fontWeight": 800,
                                            "lineHeight": 16,
                                            "letterSpacing": 1.2000000476837158,
                                            "textAlign": "left",
                                            "verticalAlign": "top",
                                            "color": "#000000",
                                            "textDecoration": "none",
                                            "textTransform": "uppercase"
                                          }
                                        }
                                      ]
                                    },
                                    {
                                      "id": "4:175",
                                      "name": "Paragraph",
                                      "type": "container",
                                      "visible": true,
                                      "width": 149.60000610351562,
                                      "height": 60,
                                      "x": 22,
                                      "y": 38,
                                      "layout": {
                                        "mode": "vertical",
                                        "padding": {
                                          "top": 12,
                                          "right": 0,
                                          "bottom": 0,
                                          "left": 0
                                        }
                                      },
                                      "layoutSelf": {
                                        "align": "auto",
                                        "sizing": {
                                          "horizontal": "fixed",
                                          "vertical": "fixed"
                                        }
                                      },
                                      "children": [
                                        {
                                          "id": "4:176",
                                          "name": "0",
                                          "type": "text",
                                          "visible": true,
                                          "width": 36,
                                          "height": 48,
                                          "x": 0,
                                          "y": 12,
                                          "layoutSelf": {
                                            "align": "auto",
                                            "sizing": {
                                              "horizontal": "hug",
                                              "vertical": "hug"
                                            }
                                          },
                                          "background": {
                                            "type": "solid",
                                            "value": "#000000"
                                          },
                                          "text": {
                                            "content": "0",
                                            "fontFamily": "Inter",
                                            "fontSize": 48,
                                            "fontWeight": 900,
                                            "lineHeight": 48,
                                            "letterSpacing": 0,
                                            "textAlign": "left",
                                            "verticalAlign": "top",
                                            "color": "#000000",
                                            "textDecoration": "none",
                                            "textTransform": "none"
                                          }
                                        }
                                      ]
                                    },
                                    {
                                      "id": "4:177",
                                      "name": "Container (margin)",
                                      "type": "container",
                                      "visible": true,
                                      "width": 149.60000610351562,
                                      "height": 44.599998474121094,
                                      "x": 22,
                                      "y": 98,
                                      "layout": {
                                        "mode": "vertical",
                                        "alignItems": "center",
                                        "padding": {
                                          "top": 16,
                                          "right": 0,
                                          "bottom": 0,
                                          "left": 0
                                        }
                                      },
                                      "layoutSelf": {
                                        "align": "stretch",
                                        "sizing": {
                                          "horizontal": "fill",
                                          "vertical": "hug"
                                        }
                                      },
                                      "children": [
                                        {
                                          "id": "4:178",
                                          "name": "Container",
                                          "type": "container",
                                          "visible": true,
                                          "width": 149.60000610351562,
                                          "height": 28.600000381469727,
                                          "x": 0,
                                          "y": 16,
                                          "layout": {
                                            "mode": "horizontal",
                                            "justifyContent": "space-between",
                                            "alignItems": "center",
                                            "padding": {
                                              "top": 12,
                                              "right": 0,
                                              "bottom": 0,
                                              "left": 0
                                            }
                                          },
                                          "layoutSelf": {
                                            "align": "stretch",
                                            "sizing": {
                                              "horizontal": "fill",
                                              "vertical": "hug"
                                            }
                                          },
                                          "border": {
                                            "color": "#000000",
                                            "width": 1,
                                            "style": "solid",
                                            "position": "inside"
                                          },
                                          "children": [
                                            {
                                              "id": "4:179",
                                              "name": "Text",
                                              "type": "container",
                                              "visible": true,
                                              "width": 65.07500457763672,
                                              "height": 15,
                                              "x": 0,
                                              "y": 14,
                                              "layoutSelf": {
                                                "align": "auto",
                                                "sizing": {
                                                  "horizontal": "fixed",
                                                  "vertical": "fixed"
                                                }
                                              },
                                              "children": [
                                                {
                                                  "id": "4:180",
                                                  "name": "This Week",
                                                  "type": "text",
                                                  "visible": true,
                                                  "width": 64,
                                                  "height": 15,
                                                  "x": 0,
                                                  "y": 0,
                                                  "background": {
                                                    "type": "solid",
                                                    "value": "#000000"
                                                  },
                                                  "text": {
                                                    "content": "This Week",
                                                    "fontFamily": "Inter",
                                                    "fontSize": 10,
                                                    "fontWeight": 800,
                                                    "lineHeight": 15,
                                                    "letterSpacing": 1,
                                                    "textAlign": "left",
                                                    "verticalAlign": "top",
                                                    "color": "#000000",
                                                    "textDecoration": "none",
                                                    "textTransform": "uppercase"
                                                  }
                                                }
                                              ]
                                            },
                                            {
                                              "id": "4:181",
                                              "name": "Text",
                                              "type": "container",
                                              "visible": true,
                                              "width": 40.01250076293945,
                                              "height": 15,
                                              "x": 110,
                                              "y": 14,
                                              "layoutSelf": {
                                                "align": "auto",
                                                "sizing": {
                                                  "horizontal": "fixed",
                                                  "vertical": "fixed"
                                                }
                                              },
                                              "children": [
                                                {
                                                  "id": "4:182",
                                                  "name": "↑ +12%",
                                                  "type": "text",
                                                  "visible": true,
                                                  "width": 39,
                                                  "height": 15,
                                                  "x": 0,
                                                  "y": 0,
                                                  "background": {
                                                    "type": "solid",
                                                    "value": "#000000"
                                                  },
                                                  "text": {
                                                    "content": "↑ +12%",
                                                    "fontFamily": "Inter",
                                                    "fontSize": 10,
                                                    "fontWeight": 900,
                                                    "lineHeight": 15,
                                                    "letterSpacing": 0,
                                                    "textAlign": "left",
                                                    "verticalAlign": "top",
                                                    "color": "#000000",
                                                    "textDecoration": "none",
                                                    "textTransform": "none"
                                                  }
                                                }
                                              ]
                                            }
                                          ]
                                        }
                                      ]
                                    }
                                  ]
                                }
                              ]
                            }
                          ]
                        },
                        {
                          "id": "4:183",
                          "name": "Container (margin)",
                          "type": "container",
                          "visible": true,
                          "width": 831.2000122070312,
                          "height": 569.5250244140625,
                          "x": 32,
                          "y": 396,
                          "layout": {
                            "mode": "vertical",
                            "padding": {
                              "top": 40,
                              "right": 0,
                              "bottom": 0,
                              "left": 0
                            }
                          },
                          "layoutSelf": {
                            "align": "stretch",
                            "sizing": {
                              "horizontal": "fill",
                              "vertical": "hug"
                            }
                          },
                          "children": [
                            {
                              "id": "4:184",
                              "name": "Container",
                              "type": "container",
                              "visible": true,
                              "width": 831.2000122070312,
                              "height": 529.5250244140625,
                              "x": 0,
                              "y": 40,
                              "layout": {
                                "mode": "vertical"
                              },
                              "layoutSelf": {
                                "align": "stretch",
                                "sizing": {
                                  "horizontal": "fill",
                                  "vertical": "hug"
                                }
                              },
                              "background": {
                                "type": "solid",
                                "value": "#ffffff"
                              },
                              "border": {
                                "color": "#000000",
                                "width": 1.600000023841858,
                                "style": "solid",
                                "position": "inside"
                              },
                              "shadow": [
                                {
                                  "type": "drop",
                                  "color": "rgba(0, 0, 0, 1.00)",
                                  "offsetX": 4,
                                  "offsetY": 4,
                                  "blur": 0,
                                  "spread": 0
                                }
                              ],
                              "children": [
                                {
                                  "id": "4:185",
                                  "name": "Container",
                                  "type": "container",
                                  "visible": true,
                                  "width": 828,
                                  "height": 62.400001525878906,
                                  "x": 2,
                                  "y": 2,
                                  "layout": {
                                    "mode": "horizontal",
                                    "justifyContent": "space-between",
                                    "alignItems": "center",
                                    "padding": {
                                      "top": 16,
                                      "right": 24,
                                      "bottom": 16,
                                      "left": 24
                                    }
                                  },
                                  "layoutSelf": {
                                    "align": "stretch",
                                    "sizing": {
                                      "horizontal": "fill",
                                      "vertical": "hug"
                                    }
                                  },
                                  "background": {
                                    "type": "solid",
                                    "value": "#f0efea"
                                  },
                                  "border": {
                                    "color": "#000000",
                                    "width": 1,
                                    "style": "solid",
                                    "position": "inside"
                                  },
                                  "children": [
                                    {
                                      "id": "4:186",
                                      "name": "Heading 2",
                                      "type": "container",
                                      "visible": true,
                                      "width": 155.875,
                                      "height": 28.80000114440918,
                                      "x": 24,
                                      "y": 16,
                                      "layoutSelf": {
                                        "align": "auto",
                                        "sizing": {
                                          "horizontal": "fixed",
                                          "vertical": "fixed"
                                        }
                                      },
                                      "children": [
                                        {
                                          "id": "4:187",
                                          "name": "Recent Tasks",
                                          "type": "text",
                                          "visible": true,
                                          "width": 157,
                                          "height": 29,
                                          "x": 0,
                                          "y": 0,
                                          "background": {
                                            "type": "solid",
                                            "value": "#000000"
                                          },
                                          "text": {
                                            "content": "Recent Tasks",
                                            "fontFamily": "Inter",
                                            "fontSize": 24,
                                            "fontWeight": 800,
                                            "lineHeight": 28.799999237060547,
                                            "letterSpacing": -0.23999999463558197,
                                            "textAlign": "left",
                                            "verticalAlign": "top",
                                            "color": "#000000",
                                            "textDecoration": "none",
                                            "textTransform": "none"
                                          }
                                        }
                                      ]
                                    },
                                    {
                                      "id": "4:188",
                                      "name": "Text",
                                      "type": "container",
                                      "visible": true,
                                      "width": 57.087501525878906,
                                      "height": 15.987500190734863,
                                      "x": 747,
                                      "y": 22,
                                      "layoutSelf": {
                                        "align": "auto",
                                        "sizing": {
                                          "horizontal": "fixed",
                                          "vertical": "fixed"
                                        }
                                      },
                                      "children": [
                                        {
                                          "id": "4:189",
                                          "name": "6 items",
                                          "type": "text",
                                          "visible": true,
                                          "width": 56,
                                          "height": 16,
                                          "x": 0,
                                          "y": 0,
                                          "background": {
                                            "type": "solid",
                                            "value": "#000000"
                                          },
                                          "text": {
                                            "content": "6 items",
                                            "fontFamily": "Inter",
                                            "fontSize": 12,
                                            "fontWeight": 800,
                                            "lineHeight": 16,
                                            "letterSpacing": 1.2000000476837158,
                                            "textAlign": "left",
                                            "verticalAlign": "top",
                                            "color": "#000000",
                                            "textDecoration": "none",
                                            "textTransform": "uppercase"
                                          }
                                        }
                                      ]
                                    }
                                  ]
                                },
                                {
                                  "id": "4:190",
                                  "name": "Container",
                                  "type": "container",
                                  "visible": true,
                                  "width": 828,
                                  "height": 463.9250183105469,
                                  "x": 2,
                                  "y": 64,
                                  "layout": {
                                    "mode": "vertical"
                                  },
                                  "layoutSelf": {
                                    "align": "stretch",
                                    "sizing": {
                                      "horizontal": "fill",
                                      "vertical": "hug"
                                    }
                                  },
                                  "children": [
                                    {
                                      "id": "4:191",
                                      "name": "Container",
                                      "type": "container",
                                      "visible": true,
                                      "width": 828,
                                      "height": 75.98750305175781,
                                      "x": 0,
                                      "y": 0,
                                      "layout": {
                                        "mode": "horizontal",
                                        "alignItems": "center",
                                        "gap": 16,
                                        "padding": {
                                          "top": 16,
                                          "right": 24,
                                          "bottom": 16,
                                          "left": 24
                                        }
                                      },
                                      "layoutSelf": {
                                        "align": "stretch",
                                        "sizing": {
                                          "horizontal": "hug",
                                          "vertical": "hug"
                                        }
                                      },
                                      "children": [
                                        {
                                          "id": "4:192",
                                          "name": "Button",
                                          "type": "button",
                                          "visible": true,
                                          "width": 28,
                                          "height": 28,
                                          "x": 24,
                                          "y": 24,
                                          "layoutSelf": {
                                            "align": "auto",
                                            "sizing": {
                                              "horizontal": "fixed",
                                              "vertical": "fixed"
                                            }
                                          },
                                          "background": {
                                            "type": "solid",
                                            "value": "#ffffff"
                                          },
                                          "border": {
                                            "color": "#000000",
                                            "width": 1.600000023841858,
                                            "style": "solid",
                                            "position": "inside"
                                          },
                                          "borderRadius": {
                                            "topLeft": 26843500,
                                            "topRight": 26843500,
                                            "bottomRight": 26843500,
                                            "bottomLeft": 26843500
                                          }
                                        },
                                        {
                                          "id": "4:193",
                                          "name": "Container",
                                          "type": "container",
                                          "visible": true,
                                          "width": 671.4375,
                                          "height": 43.98749923706055,
                                          "x": 68,
                                          "y": 16,
                                          "layout": {
                                            "mode": "vertical"
                                          },
                                          "layoutSelf": {
                                            "align": "auto",
                                            "flexGrow": 671.4375,
                                            "sizing": {
                                              "horizontal": "fill",
                                              "vertical": "hug"
                                            }
                                          },
                                          "children": [
                                            {
                                              "id": "4:194",
                                              "name": "Heading 3",
                                              "type": "container",
                                              "visible": true,
                                              "width": 671.4375,
                                              "height": 24,
                                              "x": 0,
                                              "y": 0,
                                              "layout": {
                                                "mode": "vertical"
                                              },
                                              "layoutSelf": {
                                                "align": "stretch",
                                                "sizing": {
                                                  "horizontal": "fill",
                                                  "vertical": "hug"
                                                }
                                              },
                                              "children": [
                                                {
                                                  "id": "4:195",
                                                  "name": "Update user authentication system",
                                                  "type": "text",
                                                  "visible": true,
                                                  "width": 283,
                                                  "height": 24,
                                                  "x": 0,
                                                  "y": 0,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "hug",
                                                      "vertical": "hug"
                                                    }
                                                  },
                                                  "background": {
                                                    "type": "solid",
                                                    "value": "#000000"
                                                  },
                                                  "text": {
                                                    "content": "Update user authentication system",
                                                    "fontFamily": "Inter",
                                                    "fontSize": 16,
                                                    "fontWeight": 900,
                                                    "lineHeight": 24,
                                                    "letterSpacing": 0,
                                                    "textAlign": "left",
                                                    "verticalAlign": "top",
                                                    "color": "#000000",
                                                    "textDecoration": "none",
                                                    "textTransform": "none"
                                                  }
                                                }
                                              ]
                                            },
                                            {
                                              "id": "4:196",
                                              "name": "Container",
                                              "type": "container",
                                              "visible": true,
                                              "width": 671.4375,
                                              "height": 19.987499237060547,
                                              "x": 0,
                                              "y": 24,
                                              "layout": {
                                                "mode": "horizontal",
                                                "alignItems": "center",
                                                "gap": 12,
                                                "padding": {
                                                  "top": 4,
                                                  "right": 0,
                                                  "bottom": 0,
                                                  "left": 0
                                                }
                                              },
                                              "layoutSelf": {
                                                "align": "auto",
                                                "sizing": {
                                                  "horizontal": "fixed",
                                                  "vertical": "fixed"
                                                }
                                              },
                                              "children": [
                                                {
                                                  "id": "4:197",
                                                  "name": "Text",
                                                  "type": "container",
                                                  "visible": true,
                                                  "width": 93.625,
                                                  "height": 15.987500190734863,
                                                  "x": 0,
                                                  "y": 4,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "fixed",
                                                      "vertical": "fixed"
                                                    }
                                                  },
                                                  "children": [
                                                    {
                                                      "id": "4:198",
                                                      "name": "In Progress",
                                                      "type": "text",
                                                      "visible": true,
                                                      "width": 93,
                                                      "height": 16,
                                                      "x": 0,
                                                      "y": 0,
                                                      "background": {
                                                        "type": "solid",
                                                        "value": "#525252"
                                                      },
                                                      "text": {
                                                        "content": "In Progress",
                                                        "fontFamily": "Inter",
                                                        "fontSize": 12,
                                                        "fontWeight": 800,
                                                        "lineHeight": 16,
                                                        "letterSpacing": 1.2000000476837158,
                                                        "textAlign": "left",
                                                        "verticalAlign": "top",
                                                        "color": "#525252",
                                                        "textDecoration": "none",
                                                        "textTransform": "uppercase"
                                                      }
                                                    }
                                                  ]
                                                },
                                                {
                                                  "id": "4:199",
                                                  "name": "Text",
                                                  "type": "container",
                                                  "visible": true,
                                                  "width": 5.4375,
                                                  "height": 15.987500190734863,
                                                  "x": 106,
                                                  "y": 4,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "fixed",
                                                      "vertical": "fixed"
                                                    }
                                                  },
                                                  "children": [
                                                    {
                                                      "id": "4:200",
                                                      "name": "·",
                                                      "type": "text",
                                                      "visible": true,
                                                      "width": 4,
                                                      "height": 16,
                                                      "x": 0,
                                                      "y": 0,
                                                      "background": {
                                                        "type": "solid",
                                                        "value": "#525252"
                                                      },
                                                      "text": {
                                                        "content": "·",
                                                        "fontFamily": "Inter",
                                                        "fontSize": 12,
                                                        "fontWeight": 800,
                                                        "lineHeight": 16,
                                                        "letterSpacing": 1.2000000476837158,
                                                        "textAlign": "left",
                                                        "verticalAlign": "top",
                                                        "color": "#525252",
                                                        "textDecoration": "none",
                                                        "textTransform": "uppercase"
                                                      }
                                                    }
                                                  ]
                                                },
                                                {
                                                  "id": "4:201",
                                                  "name": "Text",
                                                  "type": "container",
                                                  "visible": true,
                                                  "width": 119.1624984741211,
                                                  "height": 15.987500190734863,
                                                  "x": 123,
                                                  "y": 4,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "fixed",
                                                      "vertical": "fixed"
                                                    }
                                                  },
                                                  "children": [
                                                    {
                                                      "id": "4:202",
                                                      "name": "Due 2026-06-05",
                                                      "type": "text",
                                                      "visible": true,
                                                      "width": 120,
                                                      "height": 16,
                                                      "x": 0,
                                                      "y": 0,
                                                      "background": {
                                                        "type": "solid",
                                                        "value": "#525252"
                                                      },
                                                      "text": {
                                                        "content": "Due 2026-06-05",
                                                        "fontFamily": "Inter",
                                                        "fontSize": 12,
                                                        "fontWeight": 800,
                                                        "lineHeight": 16,
                                                        "letterSpacing": 1.2000000476837158,
                                                        "textAlign": "left",
                                                        "verticalAlign": "top",
                                                        "color": "#525252",
                                                        "textDecoration": "none",
                                                        "textTransform": "uppercase"
                                                      }
                                                    }
                                                  ]
                                                }
                                              ]
                                            }
                                          ]
                                        },
                                        {
                                          "id": "4:203",
                                          "name": "Text",
                                          "type": "container",
                                          "visible": true,
                                          "width": 48.5625,
                                          "height": 26.200000762939453,
                                          "x": 755,
                                          "y": 25,
                                          "layoutSelf": {
                                            "align": "auto",
                                            "sizing": {
                                              "horizontal": "fixed",
                                              "vertical": "fixed"
                                            }
                                          },
                                          "background": {
                                            "type": "solid",
                                            "value": "#fecdd3"
                                          },
                                          "border": {
                                            "color": "#000000",
                                            "width": 1.600000023841858,
                                            "style": "solid",
                                            "position": "inside"
                                          },
                                          "children": [
                                            {
                                              "id": "4:204",
                                              "name": "High",
                                              "type": "text",
                                              "visible": true,
                                              "width": 29,
                                              "height": 15,
                                              "x": 10,
                                              "y": 5,
                                              "background": {
                                                "type": "solid",
                                                "value": "#000000"
                                              },
                                              "text": {
                                                "content": "High",
                                                "fontFamily": "Inter",
                                                "fontSize": 10,
                                                "fontWeight": 800,
                                                "lineHeight": 15,
                                                "letterSpacing": 1,
                                                "textAlign": "left",
                                                "verticalAlign": "top",
                                                "color": "#000000",
                                                "textDecoration": "none",
                                                "textTransform": "uppercase"
                                              }
                                            }
                                          ]
                                        }
                                      ]
                                    },
                                    {
                                      "id": "4:205",
                                      "name": "Container",
                                      "type": "container",
                                      "visible": true,
                                      "width": 828,
                                      "height": 77.5875015258789,
                                      "x": 0,
                                      "y": 76,
                                      "layout": {
                                        "mode": "horizontal",
                                        "alignItems": "center",
                                        "gap": 16,
                                        "padding": {
                                          "top": 16,
                                          "right": 24,
                                          "bottom": 16,
                                          "left": 24
                                        }
                                      },
                                      "layoutSelf": {
                                        "align": "stretch",
                                        "sizing": {
                                          "horizontal": "hug",
                                          "vertical": "hug"
                                        }
                                      },
                                      "border": {
                                        "color": "#000000",
                                        "width": 1,
                                        "style": "solid",
                                        "position": "inside"
                                      },
                                      "children": [
                                        {
                                          "id": "4:206",
                                          "name": "Button",
                                          "type": "button",
                                          "visible": true,
                                          "width": 28,
                                          "height": 28,
                                          "x": 24,
                                          "y": 26,
                                          "layoutSelf": {
                                            "align": "auto",
                                            "sizing": {
                                              "horizontal": "fixed",
                                              "vertical": "fixed"
                                            }
                                          },
                                          "background": {
                                            "type": "solid",
                                            "value": "#ffffff"
                                          },
                                          "border": {
                                            "color": "#000000",
                                            "width": 1.600000023841858,
                                            "style": "solid",
                                            "position": "inside"
                                          },
                                          "borderRadius": {
                                            "topLeft": 26843500,
                                            "topRight": 26843500,
                                            "bottomRight": 26843500,
                                            "bottomLeft": 26843500
                                          }
                                        },
                                        {
                                          "id": "4:207",
                                          "name": "Container",
                                          "type": "container",
                                          "visible": true,
                                          "width": 652.4750366210938,
                                          "height": 43.98749923706055,
                                          "x": 68,
                                          "y": 18,
                                          "layout": {
                                            "mode": "vertical"
                                          },
                                          "layoutSelf": {
                                            "align": "auto",
                                            "flexGrow": 652.4750366210938,
                                            "sizing": {
                                              "horizontal": "fill",
                                              "vertical": "hug"
                                            }
                                          },
                                          "children": [
                                            {
                                              "id": "4:208",
                                              "name": "Heading 3",
                                              "type": "container",
                                              "visible": true,
                                              "width": 652.4750366210938,
                                              "height": 24,
                                              "x": 0,
                                              "y": 0,
                                              "layout": {
                                                "mode": "vertical"
                                              },
                                              "layoutSelf": {
                                                "align": "stretch",
                                                "sizing": {
                                                  "horizontal": "fill",
                                                  "vertical": "hug"
                                                }
                                              },
                                              "children": [
                                                {
                                                  "id": "4:209",
                                                  "name": "Design new dashboard layout",
                                                  "type": "text",
                                                  "visible": true,
                                                  "width": 237,
                                                  "height": 24,
                                                  "x": 0,
                                                  "y": 0,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "hug",
                                                      "vertical": "hug"
                                                    }
                                                  },
                                                  "background": {
                                                    "type": "solid",
                                                    "value": "#000000"
                                                  },
                                                  "text": {
                                                    "content": "Design new dashboard layout",
                                                    "fontFamily": "Inter",
                                                    "fontSize": 16,
                                                    "fontWeight": 900,
                                                    "lineHeight": 24,
                                                    "letterSpacing": 0,
                                                    "textAlign": "left",
                                                    "verticalAlign": "top",
                                                    "color": "#000000",
                                                    "textDecoration": "none",
                                                    "textTransform": "none"
                                                  }
                                                }
                                              ]
                                            },
                                            {
                                              "id": "4:210",
                                              "name": "Container",
                                              "type": "container",
                                              "visible": true,
                                              "width": 652.4750366210938,
                                              "height": 19.987499237060547,
                                              "x": 0,
                                              "y": 24,
                                              "layout": {
                                                "mode": "horizontal",
                                                "alignItems": "center",
                                                "gap": 12,
                                                "padding": {
                                                  "top": 4,
                                                  "right": 0,
                                                  "bottom": 0,
                                                  "left": 0
                                                }
                                              },
                                              "layoutSelf": {
                                                "align": "auto",
                                                "sizing": {
                                                  "horizontal": "fixed",
                                                  "vertical": "fixed"
                                                }
                                              },
                                              "children": [
                                                {
                                                  "id": "4:211",
                                                  "name": "Text",
                                                  "type": "container",
                                                  "visible": true,
                                                  "width": 43.587501525878906,
                                                  "height": 15.987500190734863,
                                                  "x": 0,
                                                  "y": 4,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "fixed",
                                                      "vertical": "fixed"
                                                    }
                                                  },
                                                  "children": [
                                                    {
                                                      "id": "4:212",
                                                      "name": "To Do",
                                                      "type": "text",
                                                      "visible": true,
                                                      "width": 43,
                                                      "height": 16,
                                                      "x": 0,
                                                      "y": 0,
                                                      "background": {
                                                        "type": "solid",
                                                        "value": "#525252"
                                                      },
                                                      "text": {
                                                        "content": "To Do",
                                                        "fontFamily": "Inter",
                                                        "fontSize": 12,
                                                        "fontWeight": 800,
                                                        "lineHeight": 16,
                                                        "letterSpacing": 1.2000000476837158,
                                                        "textAlign": "left",
                                                        "verticalAlign": "top",
                                                        "color": "#525252",
                                                        "textDecoration": "none",
                                                        "textTransform": "uppercase"
                                                      }
                                                    }
                                                  ]
                                                },
                                                {
                                                  "id": "4:213",
                                                  "name": "Text",
                                                  "type": "container",
                                                  "visible": true,
                                                  "width": 5.4375,
                                                  "height": 15.987500190734863,
                                                  "x": 56,
                                                  "y": 4,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "fixed",
                                                      "vertical": "fixed"
                                                    }
                                                  },
                                                  "children": [
                                                    {
                                                      "id": "4:214",
                                                      "name": "·",
                                                      "type": "text",
                                                      "visible": true,
                                                      "width": 4,
                                                      "height": 16,
                                                      "x": 0,
                                                      "y": 0,
                                                      "background": {
                                                        "type": "solid",
                                                        "value": "#525252"
                                                      },
                                                      "text": {
                                                        "content": "·",
                                                        "fontFamily": "Inter",
                                                        "fontSize": 12,
                                                        "fontWeight": 800,
                                                        "lineHeight": 16,
                                                        "letterSpacing": 1.2000000476837158,
                                                        "textAlign": "left",
                                                        "verticalAlign": "top",
                                                        "color": "#525252",
                                                        "textDecoration": "none",
                                                        "textTransform": "uppercase"
                                                      }
                                                    }
                                                  ]
                                                },
                                                {
                                                  "id": "4:215",
                                                  "name": "Text",
                                                  "type": "container",
                                                  "visible": true,
                                                  "width": 119.5250015258789,
                                                  "height": 15.987500190734863,
                                                  "x": 73,
                                                  "y": 4,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "fixed",
                                                      "vertical": "fixed"
                                                    }
                                                  },
                                                  "children": [
                                                    {
                                                      "id": "4:216",
                                                      "name": "Due 2026-06-08",
                                                      "type": "text",
                                                      "visible": true,
                                                      "width": 120,
                                                      "height": 16,
                                                      "x": 0,
                                                      "y": 0,
                                                      "background": {
                                                        "type": "solid",
                                                        "value": "#525252"
                                                      },
                                                      "text": {
                                                        "content": "Due 2026-06-08",
                                                        "fontFamily": "Inter",
                                                        "fontSize": 12,
                                                        "fontWeight": 800,
                                                        "lineHeight": 16,
                                                        "letterSpacing": 1.2000000476837158,
                                                        "textAlign": "left",
                                                        "verticalAlign": "top",
                                                        "color": "#525252",
                                                        "textDecoration": "none",
                                                        "textTransform": "uppercase"
                                                      }
                                                    }
                                                  ]
                                                }
                                              ]
                                            }
                                          ]
                                        },
                                        {
                                          "id": "4:217",
                                          "name": "Text",
                                          "type": "container",
                                          "visible": true,
                                          "width": 67.5250015258789,
                                          "height": 26.200000762939453,
                                          "x": 736,
                                          "y": 26,
                                          "layoutSelf": {
                                            "align": "auto",
                                            "sizing": {
                                              "horizontal": "fixed",
                                              "vertical": "fixed"
                                            }
                                          },
                                          "background": {
                                            "type": "solid",
                                            "value": "#fde047"
                                          },
                                          "border": {
                                            "color": "#000000",
                                            "width": 1.600000023841858,
                                            "style": "solid",
                                            "position": "inside"
                                          },
                                          "children": [
                                            {
                                              "id": "4:218",
                                              "name": "Medium",
                                              "type": "text",
                                              "visible": true,
                                              "width": 48,
                                              "height": 15,
                                              "x": 10,
                                              "y": 5,
                                              "background": {
                                                "type": "solid",
                                                "value": "#000000"
                                              },
                                              "text": {
                                                "content": "Medium",
                                                "fontFamily": "Inter",
                                                "fontSize": 10,
                                                "fontWeight": 800,
                                                "lineHeight": 15,
                                                "letterSpacing": 1,
                                                "textAlign": "left",
                                                "verticalAlign": "top",
                                                "color": "#000000",
                                                "textDecoration": "none",
                                                "textTransform": "uppercase"
                                              }
                                            }
                                          ]
                                        }
                                      ]
                                    },
                                    {
                                      "id": "4:219",
                                      "name": "Container",
                                      "type": "container",
                                      "visible": true,
                                      "width": 828,
                                      "height": 77.5875015258789,
                                      "x": 0,
                                      "y": 154,
                                      "layout": {
                                        "mode": "horizontal",
                                        "alignItems": "center",
                                        "gap": 16,
                                        "padding": {
                                          "top": 16,
                                          "right": 24,
                                          "bottom": 16,
                                          "left": 24
                                        }
                                      },
                                      "layoutSelf": {
                                        "align": "stretch",
                                        "sizing": {
                                          "horizontal": "hug",
                                          "vertical": "hug"
                                        }
                                      },
                                      "border": {
                                        "color": "#000000",
                                        "width": 1,
                                        "style": "solid",
                                        "position": "inside"
                                      },
                                      "children": [
                                        {
                                          "id": "4:220",
                                          "name": "Button",
                                          "type": "button",
                                          "visible": true,
                                          "width": 28,
                                          "height": 28,
                                          "x": 24,
                                          "y": 26,
                                          "layoutSelf": {
                                            "align": "auto",
                                            "sizing": {
                                              "horizontal": "fixed",
                                              "vertical": "fixed"
                                            }
                                          },
                                          "background": {
                                            "type": "solid",
                                            "value": "#ffffff"
                                          },
                                          "border": {
                                            "color": "#000000",
                                            "width": 1.600000023841858,
                                            "style": "solid",
                                            "position": "inside"
                                          },
                                          "borderRadius": {
                                            "topLeft": 26843500,
                                            "topRight": 26843500,
                                            "bottomRight": 26843500,
                                            "bottomLeft": 26843500
                                          }
                                        },
                                        {
                                          "id": "4:221",
                                          "name": "Container",
                                          "type": "container",
                                          "visible": true,
                                          "width": 671.4375,
                                          "height": 43.98749923706055,
                                          "x": 68,
                                          "y": 18,
                                          "layout": {
                                            "mode": "vertical"
                                          },
                                          "layoutSelf": {
                                            "align": "auto",
                                            "flexGrow": 671.4375,
                                            "sizing": {
                                              "horizontal": "fill",
                                              "vertical": "hug"
                                            }
                                          },
                                          "children": [
                                            {
                                              "id": "4:222",
                                              "name": "Heading 3",
                                              "type": "container",
                                              "visible": true,
                                              "width": 671.4375,
                                              "height": 24,
                                              "x": 0,
                                              "y": 0,
                                              "layout": {
                                                "mode": "vertical"
                                              },
                                              "layoutSelf": {
                                                "align": "stretch",
                                                "sizing": {
                                                  "horizontal": "fill",
                                                  "vertical": "hug"
                                                }
                                              },
                                              "children": [
                                                {
                                                  "id": "4:223",
                                                  "name": "Fix bug in payment processing",
                                                  "type": "text",
                                                  "visible": true,
                                                  "width": 244,
                                                  "height": 24,
                                                  "x": 0,
                                                  "y": 0,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "hug",
                                                      "vertical": "hug"
                                                    }
                                                  },
                                                  "background": {
                                                    "type": "solid",
                                                    "value": "#000000"
                                                  },
                                                  "text": {
                                                    "content": "Fix bug in payment processing",
                                                    "fontFamily": "Inter",
                                                    "fontSize": 16,
                                                    "fontWeight": 900,
                                                    "lineHeight": 24,
                                                    "letterSpacing": 0,
                                                    "textAlign": "left",
                                                    "verticalAlign": "top",
                                                    "color": "#000000",
                                                    "textDecoration": "none",
                                                    "textTransform": "none"
                                                  }
                                                }
                                              ]
                                            },
                                            {
                                              "id": "4:224",
                                              "name": "Container",
                                              "type": "container",
                                              "visible": true,
                                              "width": 671.4375,
                                              "height": 19.987499237060547,
                                              "x": 0,
                                              "y": 24,
                                              "layout": {
                                                "mode": "horizontal",
                                                "alignItems": "center",
                                                "gap": 12,
                                                "padding": {
                                                  "top": 4,
                                                  "right": 0,
                                                  "bottom": 0,
                                                  "left": 0
                                                }
                                              },
                                              "layoutSelf": {
                                                "align": "auto",
                                                "sizing": {
                                                  "horizontal": "fixed",
                                                  "vertical": "fixed"
                                                }
                                              },
                                              "children": [
                                                {
                                                  "id": "4:225",
                                                  "name": "Text",
                                                  "type": "container",
                                                  "visible": true,
                                                  "width": 61.42499923706055,
                                                  "height": 15.987500190734863,
                                                  "x": 0,
                                                  "y": 4,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "fixed",
                                                      "vertical": "fixed"
                                                    }
                                                  },
                                                  "children": [
                                                    {
                                                      "id": "4:226",
                                                      "name": "Testing",
                                                      "type": "text",
                                                      "visible": true,
                                                      "width": 61,
                                                      "height": 16,
                                                      "x": 0,
                                                      "y": 0,
                                                      "background": {
                                                        "type": "solid",
                                                        "value": "#525252"
                                                      },
                                                      "text": {
                                                        "content": "Testing",
                                                        "fontFamily": "Inter",
                                                        "fontSize": 12,
                                                        "fontWeight": 800,
                                                        "lineHeight": 16,
                                                        "letterSpacing": 1.2000000476837158,
                                                        "textAlign": "left",
                                                        "verticalAlign": "top",
                                                        "color": "#525252",
                                                        "textDecoration": "none",
                                                        "textTransform": "uppercase"
                                                      }
                                                    }
                                                  ]
                                                },
                                                {
                                                  "id": "4:227",
                                                  "name": "Text",
                                                  "type": "container",
                                                  "visible": true,
                                                  "width": 5.4375,
                                                  "height": 15.987500190734863,
                                                  "x": 73,
                                                  "y": 4,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "fixed",
                                                      "vertical": "fixed"
                                                    }
                                                  },
                                                  "children": [
                                                    {
                                                      "id": "4:228",
                                                      "name": "·",
                                                      "type": "text",
                                                      "visible": true,
                                                      "width": 4,
                                                      "height": 16,
                                                      "x": 0,
                                                      "y": 0,
                                                      "background": {
                                                        "type": "solid",
                                                        "value": "#525252"
                                                      },
                                                      "text": {
                                                        "content": "·",
                                                        "fontFamily": "Inter",
                                                        "fontSize": 12,
                                                        "fontWeight": 800,
                                                        "lineHeight": 16,
                                                        "letterSpacing": 1.2000000476837158,
                                                        "textAlign": "left",
                                                        "verticalAlign": "top",
                                                        "color": "#525252",
                                                        "textDecoration": "none",
                                                        "textTransform": "uppercase"
                                                      }
                                                    }
                                                  ]
                                                },
                                                {
                                                  "id": "4:229",
                                                  "name": "Text",
                                                  "type": "container",
                                                  "visible": true,
                                                  "width": 119.4375,
                                                  "height": 15.987500190734863,
                                                  "x": 91,
                                                  "y": 4,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "fixed",
                                                      "vertical": "fixed"
                                                    }
                                                  },
                                                  "children": [
                                                    {
                                                      "id": "4:230",
                                                      "name": "Due 2026-06-03",
                                                      "type": "text",
                                                      "visible": true,
                                                      "width": 120,
                                                      "height": 16,
                                                      "x": 0,
                                                      "y": 0,
                                                      "background": {
                                                        "type": "solid",
                                                        "value": "#525252"
                                                      },
                                                      "text": {
                                                        "content": "Due 2026-06-03",
                                                        "fontFamily": "Inter",
                                                        "fontSize": 12,
                                                        "fontWeight": 800,
                                                        "lineHeight": 16,
                                                        "letterSpacing": 1.2000000476837158,
                                                        "textAlign": "left",
                                                        "verticalAlign": "top",
                                                        "color": "#525252",
                                                        "textDecoration": "none",
                                                        "textTransform": "uppercase"
                                                      }
                                                    }
                                                  ]
                                                }
                                              ]
                                            }
                                          ]
                                        },
                                        {
                                          "id": "4:231",
                                          "name": "Text",
                                          "type": "container",
                                          "visible": true,
                                          "width": 48.5625,
                                          "height": 26.200000762939453,
                                          "x": 755,
                                          "y": 26,
                                          "layoutSelf": {
                                            "align": "auto",
                                            "sizing": {
                                              "horizontal": "fixed",
                                              "vertical": "fixed"
                                            }
                                          },
                                          "background": {
                                            "type": "solid",
                                            "value": "#fecdd3"
                                          },
                                          "border": {
                                            "color": "#000000",
                                            "width": 1.600000023841858,
                                            "style": "solid",
                                            "position": "inside"
                                          },
                                          "children": [
                                            {
                                              "id": "4:232",
                                              "name": "High",
                                              "type": "text",
                                              "visible": true,
                                              "width": 29,
                                              "height": 15,
                                              "x": 10,
                                              "y": 5,
                                              "background": {
                                                "type": "solid",
                                                "value": "#000000"
                                              },
                                              "text": {
                                                "content": "High",
                                                "fontFamily": "Inter",
                                                "fontSize": 10,
                                                "fontWeight": 800,
                                                "lineHeight": 15,
                                                "letterSpacing": 1,
                                                "textAlign": "left",
                                                "verticalAlign": "top",
                                                "color": "#000000",
                                                "textDecoration": "none",
                                                "textTransform": "uppercase"
                                              }
                                            }
                                          ]
                                        }
                                      ]
                                    },
                                    {
                                      "id": "4:233",
                                      "name": "Container",
                                      "type": "container",
                                      "visible": true,
                                      "width": 828,
                                      "height": 77.5875015258789,
                                      "x": 0,
                                      "y": 231,
                                      "layout": {
                                        "mode": "horizontal",
                                        "alignItems": "center",
                                        "gap": 16,
                                        "padding": {
                                          "top": 16,
                                          "right": 24,
                                          "bottom": 16,
                                          "left": 24
                                        }
                                      },
                                      "layoutSelf": {
                                        "align": "stretch",
                                        "sizing": {
                                          "horizontal": "hug",
                                          "vertical": "hug"
                                        }
                                      },
                                      "border": {
                                        "color": "#000000",
                                        "width": 1,
                                        "style": "solid",
                                        "position": "inside"
                                      },
                                      "children": [
                                        {
                                          "id": "4:234",
                                          "name": "Button",
                                          "type": "button",
                                          "visible": true,
                                          "width": 28,
                                          "height": 28,
                                          "x": 24,
                                          "y": 26,
                                          "layout": {
                                            "mode": "horizontal",
                                            "justifyContent": "center",
                                            "alignItems": "center"
                                          },
                                          "layoutSelf": {
                                            "align": "auto",
                                            "sizing": {
                                              "horizontal": "fixed",
                                              "vertical": "fixed"
                                            }
                                          },
                                          "background": {
                                            "type": "solid",
                                            "value": "#a7f3d0"
                                          },
                                          "border": {
                                            "color": "#000000",
                                            "width": 1.600000023841858,
                                            "style": "solid",
                                            "position": "inside"
                                          },
                                          "borderRadius": {
                                            "topLeft": 26843500,
                                            "topRight": 26843500,
                                            "bottomRight": 26843500,
                                            "bottomLeft": 26843500
                                          },
                                          "children": [
                                            {
                                              "id": "4:235",
                                              "name": "Icon",
                                              "type": "icon",
                                              "visible": true,
                                              "width": 16,
                                              "height": 16,
                                              "x": 6,
                                              "y": 6,
                                              "layoutSelf": {
                                                "align": "auto",
                                                "sizing": {
                                                  "horizontal": "fixed",
                                                  "vertical": "fixed"
                                                }
                                              },
                                              "children": [
                                                {
                                                  "id": "4:236",
                                                  "name": "Vector",
                                                  "type": "icon",
                                                  "visible": true,
                                                  "width": 10.666666984558105,
                                                  "height": 7.333333492279053,
                                                  "x": 3,
                                                  "y": 4,
                                                  "border": {
                                                    "color": "#000000",
                                                    "width": 2,
                                                    "style": "solid",
                                                    "position": "center"
                                                  }
                                                }
                                              ]
                                            }
                                          ]
                                        },
                                        {
                                          "id": "4:237",
                                          "name": "Container",
                                          "type": "container",
                                          "visible": true,
                                          "width": 652.4750366210938,
                                          "height": 43.98749923706055,
                                          "x": 68,
                                          "y": 18,
                                          "layout": {
                                            "mode": "vertical"
                                          },
                                          "layoutSelf": {
                                            "align": "auto",
                                            "flexGrow": 652.4750366210938,
                                            "sizing": {
                                              "horizontal": "fill",
                                              "vertical": "hug"
                                            }
                                          },
                                          "children": [
                                            {
                                              "id": "4:238",
                                              "name": "Heading 3",
                                              "type": "container",
                                              "visible": true,
                                              "width": 652.4750366210938,
                                              "height": 24,
                                              "x": 0,
                                              "y": 0,
                                              "layout": {
                                                "mode": "vertical"
                                              },
                                              "layoutSelf": {
                                                "align": "stretch",
                                                "sizing": {
                                                  "horizontal": "fill",
                                                  "vertical": "hug"
                                                }
                                              },
                                              "children": [
                                                {
                                                  "id": "4:239",
                                                  "name": "Implement email notifications",
                                                  "type": "text",
                                                  "visible": true,
                                                  "width": 240,
                                                  "height": 24,
                                                  "x": 0,
                                                  "y": 0,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "hug",
                                                      "vertical": "hug"
                                                    }
                                                  },
                                                  "background": {
                                                    "type": "solid",
                                                    "value": "#737373"
                                                  },
                                                  "text": {
                                                    "content": "Implement email notifications",
                                                    "fontFamily": "Inter",
                                                    "fontSize": 16,
                                                    "fontWeight": 900,
                                                    "lineHeight": 24,
                                                    "letterSpacing": 0,
                                                    "textAlign": "left",
                                                    "verticalAlign": "top",
                                                    "color": "#737373",
                                                    "textDecoration": "line-through",
                                                    "textTransform": "none"
                                                  }
                                                }
                                              ]
                                            },
                                            {
                                              "id": "4:240",
                                              "name": "Container",
                                              "type": "container",
                                              "visible": true,
                                              "width": 652.4750366210938,
                                              "height": 19.987499237060547,
                                              "x": 0,
                                              "y": 24,
                                              "layout": {
                                                "mode": "horizontal",
                                                "alignItems": "center",
                                                "gap": 12,
                                                "padding": {
                                                  "top": 4,
                                                  "right": 0,
                                                  "bottom": 0,
                                                  "left": 0
                                                }
                                              },
                                              "layoutSelf": {
                                                "align": "auto",
                                                "sizing": {
                                                  "horizontal": "fixed",
                                                  "vertical": "fixed"
                                                }
                                              },
                                              "children": [
                                                {
                                                  "id": "4:241",
                                                  "name": "Text",
                                                  "type": "container",
                                                  "visible": true,
                                                  "width": 39.26250076293945,
                                                  "height": 15.987500190734863,
                                                  "x": 0,
                                                  "y": 4,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "fixed",
                                                      "vertical": "fixed"
                                                    }
                                                  },
                                                  "children": [
                                                    {
                                                      "id": "4:242",
                                                      "name": "Done",
                                                      "type": "text",
                                                      "visible": true,
                                                      "width": 38,
                                                      "height": 16,
                                                      "x": 0,
                                                      "y": 0,
                                                      "background": {
                                                        "type": "solid",
                                                        "value": "#525252"
                                                      },
                                                      "text": {
                                                        "content": "Done",
                                                        "fontFamily": "Inter",
                                                        "fontSize": 12,
                                                        "fontWeight": 800,
                                                        "lineHeight": 16,
                                                        "letterSpacing": 1.2000000476837158,
                                                        "textAlign": "left",
                                                        "verticalAlign": "top",
                                                        "color": "#525252",
                                                        "textDecoration": "none",
                                                        "textTransform": "uppercase"
                                                      }
                                                    }
                                                  ]
                                                },
                                                {
                                                  "id": "4:243",
                                                  "name": "Text",
                                                  "type": "container",
                                                  "visible": true,
                                                  "width": 5.4375,
                                                  "height": 15.987500190734863,
                                                  "x": 51,
                                                  "y": 4,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "fixed",
                                                      "vertical": "fixed"
                                                    }
                                                  },
                                                  "children": [
                                                    {
                                                      "id": "4:244",
                                                      "name": "·",
                                                      "type": "text",
                                                      "visible": true,
                                                      "width": 4,
                                                      "height": 16,
                                                      "x": 0,
                                                      "y": 0,
                                                      "background": {
                                                        "type": "solid",
                                                        "value": "#525252"
                                                      },
                                                      "text": {
                                                        "content": "·",
                                                        "fontFamily": "Inter",
                                                        "fontSize": 12,
                                                        "fontWeight": 800,
                                                        "lineHeight": 16,
                                                        "letterSpacing": 1.2000000476837158,
                                                        "textAlign": "left",
                                                        "verticalAlign": "top",
                                                        "color": "#525252",
                                                        "textDecoration": "none",
                                                        "textTransform": "uppercase"
                                                      }
                                                    }
                                                  ]
                                                },
                                                {
                                                  "id": "4:245",
                                                  "name": "Text",
                                                  "type": "container",
                                                  "visible": true,
                                                  "width": 119.07500457763672,
                                                  "height": 15.987500190734863,
                                                  "x": 69,
                                                  "y": 4,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "fixed",
                                                      "vertical": "fixed"
                                                    }
                                                  },
                                                  "children": [
                                                    {
                                                      "id": "4:246",
                                                      "name": "Due 2026-05-30",
                                                      "type": "text",
                                                      "visible": true,
                                                      "width": 120,
                                                      "height": 16,
                                                      "x": 0,
                                                      "y": 0,
                                                      "background": {
                                                        "type": "solid",
                                                        "value": "#525252"
                                                      },
                                                      "text": {
                                                        "content": "Due 2026-05-30",
                                                        "fontFamily": "Inter",
                                                        "fontSize": 12,
                                                        "fontWeight": 800,
                                                        "lineHeight": 16,
                                                        "letterSpacing": 1.2000000476837158,
                                                        "textAlign": "left",
                                                        "verticalAlign": "top",
                                                        "color": "#525252",
                                                        "textDecoration": "none",
                                                        "textTransform": "uppercase"
                                                      }
                                                    }
                                                  ]
                                                }
                                              ]
                                            }
                                          ]
                                        },
                                        {
                                          "id": "4:247",
                                          "name": "Text",
                                          "type": "container",
                                          "visible": true,
                                          "width": 67.5250015258789,
                                          "height": 26.200000762939453,
                                          "x": 736,
                                          "y": 26,
                                          "layoutSelf": {
                                            "align": "auto",
                                            "sizing": {
                                              "horizontal": "fixed",
                                              "vertical": "fixed"
                                            }
                                          },
                                          "background": {
                                            "type": "solid",
                                            "value": "#fde047"
                                          },
                                          "border": {
                                            "color": "#000000",
                                            "width": 1.600000023841858,
                                            "style": "solid",
                                            "position": "inside"
                                          },
                                          "children": [
                                            {
                                              "id": "4:248",
                                              "name": "Medium",
                                              "type": "text",
                                              "visible": true,
                                              "width": 48,
                                              "height": 15,
                                              "x": 10,
                                              "y": 5,
                                              "background": {
                                                "type": "solid",
                                                "value": "#000000"
                                              },
                                              "text": {
                                                "content": "Medium",
                                                "fontFamily": "Inter",
                                                "fontSize": 10,
                                                "fontWeight": 800,
                                                "lineHeight": 15,
                                                "letterSpacing": 1,
                                                "textAlign": "left",
                                                "verticalAlign": "top",
                                                "color": "#000000",
                                                "textDecoration": "none",
                                                "textTransform": "uppercase"
                                              }
                                            }
                                          ]
                                        }
                                      ]
                                    },
                                    {
                                      "id": "4:249",
                                      "name": "Container",
                                      "type": "container",
                                      "visible": true,
                                      "width": 828,
                                      "height": 77.5875015258789,
                                      "x": 0,
                                      "y": 309,
                                      "layout": {
                                        "mode": "horizontal",
                                        "alignItems": "center",
                                        "gap": 16,
                                        "padding": {
                                          "top": 16,
                                          "right": 24,
                                          "bottom": 16,
                                          "left": 24
                                        }
                                      },
                                      "layoutSelf": {
                                        "align": "stretch",
                                        "sizing": {
                                          "horizontal": "hug",
                                          "vertical": "hug"
                                        }
                                      },
                                      "border": {
                                        "color": "#000000",
                                        "width": 1,
                                        "style": "solid",
                                        "position": "inside"
                                      },
                                      "children": [
                                        {
                                          "id": "4:250",
                                          "name": "Button",
                                          "type": "button",
                                          "visible": true,
                                          "width": 28,
                                          "height": 28,
                                          "x": 24,
                                          "y": 26,
                                          "layoutSelf": {
                                            "align": "auto",
                                            "sizing": {
                                              "horizontal": "fixed",
                                              "vertical": "fixed"
                                            }
                                          },
                                          "background": {
                                            "type": "solid",
                                            "value": "#ffffff"
                                          },
                                          "border": {
                                            "color": "#000000",
                                            "width": 1.600000023841858,
                                            "style": "solid",
                                            "position": "inside"
                                          },
                                          "borderRadius": {
                                            "topLeft": 26843500,
                                            "topRight": 26843500,
                                            "bottomRight": 26843500,
                                            "bottomLeft": 26843500
                                          }
                                        },
                                        {
                                          "id": "4:251",
                                          "name": "Container",
                                          "type": "container",
                                          "visible": true,
                                          "width": 674.4500122070312,
                                          "height": 43.98749923706055,
                                          "x": 68,
                                          "y": 18,
                                          "layout": {
                                            "mode": "vertical"
                                          },
                                          "layoutSelf": {
                                            "align": "auto",
                                            "flexGrow": 674.4500122070312,
                                            "sizing": {
                                              "horizontal": "fill",
                                              "vertical": "hug"
                                            }
                                          },
                                          "children": [
                                            {
                                              "id": "4:252",
                                              "name": "Heading 3",
                                              "type": "container",
                                              "visible": true,
                                              "width": 674.4500122070312,
                                              "height": 24,
                                              "x": 0,
                                              "y": 0,
                                              "layout": {
                                                "mode": "vertical"
                                              },
                                              "layoutSelf": {
                                                "align": "stretch",
                                                "sizing": {
                                                  "horizontal": "fill",
                                                  "vertical": "hug"
                                                }
                                              },
                                              "children": [
                                                {
                                                  "id": "4:253",
                                                  "name": "Write API documentation",
                                                  "type": "text",
                                                  "visible": true,
                                                  "width": 203,
                                                  "height": 24,
                                                  "x": 0,
                                                  "y": 0,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "hug",
                                                      "vertical": "hug"
                                                    }
                                                  },
                                                  "background": {
                                                    "type": "solid",
                                                    "value": "#000000"
                                                  },
                                                  "text": {
                                                    "content": "Write API documentation",
                                                    "fontFamily": "Inter",
                                                    "fontSize": 16,
                                                    "fontWeight": 900,
                                                    "lineHeight": 24,
                                                    "letterSpacing": 0,
                                                    "textAlign": "left",
                                                    "verticalAlign": "top",
                                                    "color": "#000000",
                                                    "textDecoration": "none",
                                                    "textTransform": "none"
                                                  }
                                                }
                                              ]
                                            },
                                            {
                                              "id": "4:254",
                                              "name": "Container",
                                              "type": "container",
                                              "visible": true,
                                              "width": 674.4500122070312,
                                              "height": 19.987499237060547,
                                              "x": 0,
                                              "y": 24,
                                              "layout": {
                                                "mode": "horizontal",
                                                "alignItems": "center",
                                                "gap": 12,
                                                "padding": {
                                                  "top": 4,
                                                  "right": 0,
                                                  "bottom": 0,
                                                  "left": 0
                                                }
                                              },
                                              "layoutSelf": {
                                                "align": "auto",
                                                "sizing": {
                                                  "horizontal": "fixed",
                                                  "vertical": "fixed"
                                                }
                                              },
                                              "children": [
                                                {
                                                  "id": "4:255",
                                                  "name": "Text",
                                                  "type": "container",
                                                  "visible": true,
                                                  "width": 93.625,
                                                  "height": 15.987500190734863,
                                                  "x": 0,
                                                  "y": 4,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "fixed",
                                                      "vertical": "fixed"
                                                    }
                                                  },
                                                  "children": [
                                                    {
                                                      "id": "4:256",
                                                      "name": "In Progress",
                                                      "type": "text",
                                                      "visible": true,
                                                      "width": 93,
                                                      "height": 16,
                                                      "x": 0,
                                                      "y": 0,
                                                      "background": {
                                                        "type": "solid",
                                                        "value": "#525252"
                                                      },
                                                      "text": {
                                                        "content": "In Progress",
                                                        "fontFamily": "Inter",
                                                        "fontSize": 12,
                                                        "fontWeight": 800,
                                                        "lineHeight": 16,
                                                        "letterSpacing": 1.2000000476837158,
                                                        "textAlign": "left",
                                                        "verticalAlign": "top",
                                                        "color": "#525252",
                                                        "textDecoration": "none",
                                                        "textTransform": "uppercase"
                                                      }
                                                    }
                                                  ]
                                                },
                                                {
                                                  "id": "4:257",
                                                  "name": "Text",
                                                  "type": "container",
                                                  "visible": true,
                                                  "width": 5.4375,
                                                  "height": 15.987500190734863,
                                                  "x": 106,
                                                  "y": 4,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "fixed",
                                                      "vertical": "fixed"
                                                    }
                                                  },
                                                  "children": [
                                                    {
                                                      "id": "4:258",
                                                      "name": "·",
                                                      "type": "text",
                                                      "visible": true,
                                                      "width": 4,
                                                      "height": 16,
                                                      "x": 0,
                                                      "y": 0,
                                                      "background": {
                                                        "type": "solid",
                                                        "value": "#525252"
                                                      },
                                                      "text": {
                                                        "content": "·",
                                                        "fontFamily": "Inter",
                                                        "fontSize": 12,
                                                        "fontWeight": 800,
                                                        "lineHeight": 16,
                                                        "letterSpacing": 1.2000000476837158,
                                                        "textAlign": "left",
                                                        "verticalAlign": "top",
                                                        "color": "#525252",
                                                        "textDecoration": "none",
                                                        "textTransform": "uppercase"
                                                      }
                                                    }
                                                  ]
                                                },
                                                {
                                                  "id": "4:259",
                                                  "name": "Text",
                                                  "type": "container",
                                                  "visible": true,
                                                  "width": 118.375,
                                                  "height": 15.987500190734863,
                                                  "x": 123,
                                                  "y": 4,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "fixed",
                                                      "vertical": "fixed"
                                                    }
                                                  },
                                                  "children": [
                                                    {
                                                      "id": "4:260",
                                                      "name": "Due 2026-06-07",
                                                      "type": "text",
                                                      "visible": true,
                                                      "width": 119,
                                                      "height": 16,
                                                      "x": 0,
                                                      "y": 0,
                                                      "background": {
                                                        "type": "solid",
                                                        "value": "#525252"
                                                      },
                                                      "text": {
                                                        "content": "Due 2026-06-07",
                                                        "fontFamily": "Inter",
                                                        "fontSize": 12,
                                                        "fontWeight": 800,
                                                        "lineHeight": 16,
                                                        "letterSpacing": 1.2000000476837158,
                                                        "textAlign": "left",
                                                        "verticalAlign": "top",
                                                        "color": "#525252",
                                                        "textDecoration": "none",
                                                        "textTransform": "uppercase"
                                                      }
                                                    }
                                                  ]
                                                }
                                              ]
                                            }
                                          ]
                                        },
                                        {
                                          "id": "4:261",
                                          "name": "Text",
                                          "type": "container",
                                          "visible": true,
                                          "width": 45.54999923706055,
                                          "height": 26.200000762939453,
                                          "x": 758,
                                          "y": 26,
                                          "layoutSelf": {
                                            "align": "auto",
                                            "sizing": {
                                              "horizontal": "fixed",
                                              "vertical": "fixed"
                                            }
                                          },
                                          "background": {
                                            "type": "solid",
                                            "value": "#a7f3d0"
                                          },
                                          "border": {
                                            "color": "#000000",
                                            "width": 1.600000023841858,
                                            "style": "solid",
                                            "position": "inside"
                                          },
                                          "children": [
                                            {
                                              "id": "4:262",
                                              "name": "Low",
                                              "type": "text",
                                              "visible": true,
                                              "width": 26,
                                              "height": 15,
                                              "x": 10,
                                              "y": 5,
                                              "background": {
                                                "type": "solid",
                                                "value": "#000000"
                                              },
                                              "text": {
                                                "content": "Low",
                                                "fontFamily": "Inter",
                                                "fontSize": 10,
                                                "fontWeight": 800,
                                                "lineHeight": 15,
                                                "letterSpacing": 1,
                                                "textAlign": "left",
                                                "verticalAlign": "top",
                                                "color": "#000000",
                                                "textDecoration": "none",
                                                "textTransform": "uppercase"
                                              }
                                            }
                                          ]
                                        }
                                      ]
                                    },
                                    {
                                      "id": "4:263",
                                      "name": "Container",
                                      "type": "container",
                                      "visible": true,
                                      "width": 828,
                                      "height": 77.5875015258789,
                                      "x": 0,
                                      "y": 386,
                                      "layout": {
                                        "mode": "horizontal",
                                        "alignItems": "center",
                                        "gap": 16,
                                        "padding": {
                                          "top": 16,
                                          "right": 24,
                                          "bottom": 16,
                                          "left": 24
                                        }
                                      },
                                      "layoutSelf": {
                                        "align": "stretch",
                                        "sizing": {
                                          "horizontal": "hug",
                                          "vertical": "hug"
                                        }
                                      },
                                      "border": {
                                        "color": "#000000",
                                        "width": 1,
                                        "style": "solid",
                                        "position": "inside"
                                      },
                                      "children": [
                                        {
                                          "id": "4:264",
                                          "name": "Button",
                                          "type": "button",
                                          "visible": true,
                                          "width": 28,
                                          "height": 28,
                                          "x": 24,
                                          "y": 26,
                                          "layoutSelf": {
                                            "align": "auto",
                                            "sizing": {
                                              "horizontal": "fixed",
                                              "vertical": "fixed"
                                            }
                                          },
                                          "background": {
                                            "type": "solid",
                                            "value": "#ffffff"
                                          },
                                          "border": {
                                            "color": "#000000",
                                            "width": 1.600000023841858,
                                            "style": "solid",
                                            "position": "inside"
                                          },
                                          "borderRadius": {
                                            "topLeft": 26843500,
                                            "topRight": 26843500,
                                            "bottomRight": 26843500,
                                            "bottomLeft": 26843500
                                          }
                                        },
                                        {
                                          "id": "4:265",
                                          "name": "Container",
                                          "type": "container",
                                          "visible": true,
                                          "width": 652.4750366210938,
                                          "height": 43.98749923706055,
                                          "x": 68,
                                          "y": 18,
                                          "layout": {
                                            "mode": "vertical"
                                          },
                                          "layoutSelf": {
                                            "align": "auto",
                                            "flexGrow": 652.4750366210938,
                                            "sizing": {
                                              "horizontal": "fill",
                                              "vertical": "hug"
                                            }
                                          },
                                          "children": [
                                            {
                                              "id": "4:266",
                                              "name": "Heading 3",
                                              "type": "container",
                                              "visible": true,
                                              "width": 652.4750366210938,
                                              "height": 24,
                                              "x": 0,
                                              "y": 0,
                                              "layout": {
                                                "mode": "vertical"
                                              },
                                              "layoutSelf": {
                                                "align": "stretch",
                                                "sizing": {
                                                  "horizontal": "fill",
                                                  "vertical": "hug"
                                                }
                                              },
                                              "children": [
                                                {
                                                  "id": "4:267",
                                                  "name": "Code review for feature branch",
                                                  "type": "text",
                                                  "visible": true,
                                                  "width": 248,
                                                  "height": 24,
                                                  "x": 0,
                                                  "y": 0,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "hug",
                                                      "vertical": "hug"
                                                    }
                                                  },
                                                  "background": {
                                                    "type": "solid",
                                                    "value": "#000000"
                                                  },
                                                  "text": {
                                                    "content": "Code review for feature branch",
                                                    "fontFamily": "Inter",
                                                    "fontSize": 16,
                                                    "fontWeight": 900,
                                                    "lineHeight": 24,
                                                    "letterSpacing": 0,
                                                    "textAlign": "left",
                                                    "verticalAlign": "top",
                                                    "color": "#000000",
                                                    "textDecoration": "none",
                                                    "textTransform": "none"
                                                  }
                                                }
                                              ]
                                            },
                                            {
                                              "id": "4:268",
                                              "name": "Container",
                                              "type": "container",
                                              "visible": true,
                                              "width": 652.4750366210938,
                                              "height": 19.987499237060547,
                                              "x": 0,
                                              "y": 24,
                                              "layout": {
                                                "mode": "horizontal",
                                                "alignItems": "center",
                                                "gap": 12,
                                                "padding": {
                                                  "top": 4,
                                                  "right": 0,
                                                  "bottom": 0,
                                                  "left": 0
                                                }
                                              },
                                              "layoutSelf": {
                                                "align": "auto",
                                                "sizing": {
                                                  "horizontal": "fixed",
                                                  "vertical": "fixed"
                                                }
                                              },
                                              "children": [
                                                {
                                                  "id": "4:269",
                                                  "name": "Text",
                                                  "type": "container",
                                                  "visible": true,
                                                  "width": 43.587501525878906,
                                                  "height": 15.987500190734863,
                                                  "x": 0,
                                                  "y": 4,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "fixed",
                                                      "vertical": "fixed"
                                                    }
                                                  },
                                                  "children": [
                                                    {
                                                      "id": "4:270",
                                                      "name": "To Do",
                                                      "type": "text",
                                                      "visible": true,
                                                      "width": 43,
                                                      "height": 16,
                                                      "x": 0,
                                                      "y": 0,
                                                      "background": {
                                                        "type": "solid",
                                                        "value": "#525252"
                                                      },
                                                      "text": {
                                                        "content": "To Do",
                                                        "fontFamily": "Inter",
                                                        "fontSize": 12,
                                                        "fontWeight": 800,
                                                        "lineHeight": 16,
                                                        "letterSpacing": 1.2000000476837158,
                                                        "textAlign": "left",
                                                        "verticalAlign": "top",
                                                        "color": "#525252",
                                                        "textDecoration": "none",
                                                        "textTransform": "uppercase"
                                                      }
                                                    }
                                                  ]
                                                },
                                                {
                                                  "id": "4:271",
                                                  "name": "Text",
                                                  "type": "container",
                                                  "visible": true,
                                                  "width": 5.4375,
                                                  "height": 15.987500190734863,
                                                  "x": 56,
                                                  "y": 4,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "fixed",
                                                      "vertical": "fixed"
                                                    }
                                                  },
                                                  "children": [
                                                    {
                                                      "id": "4:272",
                                                      "name": "·",
                                                      "type": "text",
                                                      "visible": true,
                                                      "width": 4,
                                                      "height": 16,
                                                      "x": 0,
                                                      "y": 0,
                                                      "background": {
                                                        "type": "solid",
                                                        "value": "#525252"
                                                      },
                                                      "text": {
                                                        "content": "·",
                                                        "fontFamily": "Inter",
                                                        "fontSize": 12,
                                                        "fontWeight": 800,
                                                        "lineHeight": 16,
                                                        "letterSpacing": 1.2000000476837158,
                                                        "textAlign": "left",
                                                        "verticalAlign": "top",
                                                        "color": "#525252",
                                                        "textDecoration": "none",
                                                        "textTransform": "uppercase"
                                                      }
                                                    }
                                                  ]
                                                },
                                                {
                                                  "id": "4:273",
                                                  "name": "Text",
                                                  "type": "container",
                                                  "visible": true,
                                                  "width": 119.8125,
                                                  "height": 15.987500190734863,
                                                  "x": 73,
                                                  "y": 4,
                                                  "layoutSelf": {
                                                    "align": "auto",
                                                    "sizing": {
                                                      "horizontal": "fixed",
                                                      "vertical": "fixed"
                                                    }
                                                  },
                                                  "children": [
                                                    {
                                                      "id": "4:274",
                                                      "name": "Due 2026-06-04",
                                                      "type": "text",
                                                      "visible": true,
                                                      "width": 120,
                                                      "height": 16,
                                                      "x": 0,
                                                      "y": 0,
                                                      "background": {
                                                        "type": "solid",
                                                        "value": "#525252"
                                                      },
                                                      "text": {
                                                        "content": "Due 2026-06-04",
                                                        "fontFamily": "Inter",
                                                        "fontSize": 12,
                                                        "fontWeight": 800,
                                                        "lineHeight": 16,
                                                        "letterSpacing": 1.2000000476837158,
                                                        "textAlign": "left",
                                                        "verticalAlign": "top",
                                                        "color": "#525252",
                                                        "textDecoration": "none",
                                                        "textTransform": "uppercase"
                                                      }
                                                    }
                                                  ]
                                                }
                                              ]
                                            }
                                          ]
                                        },
                                        {
                                          "id": "4:275",
                                          "name": "Text",
                                          "type": "container",
                                          "visible": true,
                                          "width": 67.5250015258789,
                                          "height": 26.200000762939453,
                                          "x": 736,
                                          "y": 26,
                                          "layoutSelf": {
                                            "align": "auto",
                                            "sizing": {
                                              "horizontal": "fixed",
                                              "vertical": "fixed"
                                            }
                                          },
                                          "background": {
                                            "type": "solid",
                                            "value": "#fde047"
                                          },
                                          "border": {
                                            "color": "#000000",
                                            "width": 1.600000023841858,
                                            "style": "solid",
                                            "position": "inside"
                                          },
                                          "children": [
                                            {
                                              "id": "4:276",
                                              "name": "Medium",
                                              "type": "text",
                                              "visible": true,
                                              "width": 48,
                                              "height": 15,
                                              "x": 10,
                                              "y": 5,
                                              "background": {
                                                "type": "solid",
                                                "value": "#000000"
                                              },
                                              "text": {
                                                "content": "Medium",
                                                "fontFamily": "Inter",
                                                "fontSize": 10,
                                                "fontWeight": 800,
                                                "lineHeight": 15,
                                                "letterSpacing": 1,
                                                "textAlign": "left",
                                                "verticalAlign": "top",
                                                "color": "#000000",
                                                "textDecoration": "none",
                                                "textTransform": "uppercase"
                                              }
                                            }
                                          ]
                                        }
                                      ]
                                    }
                                  ]
                                }
                              ]
                            }
                          ]
                        }
                      ]
                    }
                  ]
                }
              ]
            },
            {
              "id": "4:277",
              "name": "Sidebar",
              "type": "container",
              "visible": true,
              "width": 256,
              "height": 775.2000122070312,
              "x": 0,
              "y": 0,
              "layout": {
                "mode": "vertical"
              },
              "layoutSelf": {
                "align": "auto",
                "sizing": {
                  "horizontal": "fixed",
                  "vertical": "fixed"
                }
              },
              "background": {
                "type": "solid",
                "value": "#f0efea"
              },
              "border": {
                "color": "#000000",
                "width": 1,
                "style": "solid",
                "position": "inside"
              },
              "children": [
                {
                  "id": "4:278",
                  "name": "Container",
                  "type": "container",
                  "visible": true,
                  "width": 254.39999389648438,
                  "height": 89.5999984741211,
                  "x": 0,
                  "y": 0,
                  "layout": {
                    "mode": "vertical",
                    "padding": {
                      "top": 24,
                      "right": 24,
                      "bottom": 24,
                      "left": 24
                    }
                  },
                  "layoutSelf": {
                    "align": "stretch",
                    "sizing": {
                      "horizontal": "fill",
                      "vertical": "hug"
                    }
                  },
                  "border": {
                    "color": "#000000",
                    "width": 1,
                    "style": "solid",
                    "position": "inside"
                  },
                  "children": [
                    {
                      "id": "4:279",
                      "name": "Container",
                      "type": "container",
                      "visible": true,
                      "width": 206.39999389648438,
                      "height": 40,
                      "x": 24,
                      "y": 24,
                      "layout": {
                        "mode": "horizontal",
                        "alignItems": "center",
                        "gap": 12
                      },
                      "layoutSelf": {
                        "align": "stretch",
                        "sizing": {
                          "horizontal": "fill",
                          "vertical": "hug"
                        }
                      },
                      "children": [
                        {
                          "id": "4:280",
                          "name": "Container",
                          "type": "container",
                          "visible": true,
                          "width": 40,
                          "height": 40,
                          "x": 0,
                          "y": 0,
                          "layout": {
                            "mode": "horizontal",
                            "justifyContent": "center",
                            "alignItems": "center"
                          },
                          "layoutSelf": {
                            "align": "auto",
                            "sizing": {
                              "horizontal": "fixed",
                              "vertical": "fixed"
                            }
                          },
                          "background": {
                            "type": "solid",
                            "value": "#a7f3d0"
                          },
                          "border": {
                            "color": "#000000",
                            "width": 1.600000023841858,
                            "style": "solid",
                            "position": "inside"
                          },
                          "shadow": [
                            {
                              "type": "drop",
                              "color": "rgba(0, 0, 0, 1.00)",
                              "offsetX": 2,
                              "offsetY": 2,
                              "blur": 0,
                              "spread": 0
                            }
                          ],
                          "children": [
                            {
                              "id": "4:281",
                              "name": "W",
                              "type": "text",
                              "visible": true,
                              "width": 18,
                              "height": 24,
                              "x": 11,
                              "y": 8,
                              "layoutSelf": {
                                "align": "auto",
                                "sizing": {
                                  "horizontal": "hug",
                                  "vertical": "hug"
                                }
                              },
                              "background": {
                                "type": "solid",
                                "value": "#000000"
                              },
                              "text": {
                                "content": "W",
                                "fontFamily": "Inter",
                                "fontSize": 16,
                                "fontWeight": 900,
                                "lineHeight": 24,
                                "letterSpacing": 0,
                                "textAlign": "left",
                                "verticalAlign": "top",
                                "color": "#000000",
                                "textDecoration": "none",
                                "textTransform": "none"
                              }
                            }
                          ]
                        },
                        {
                          "id": "4:282",
                          "name": "Container",
                          "type": "container",
                          "visible": true,
                          "width": 84.2874984741211,
                          "height": 35,
                          "x": 52,
                          "y": 3,
                          "layout": {
                            "mode": "vertical"
                          },
                          "layoutSelf": {
                            "align": "auto",
                            "sizing": {
                              "horizontal": "fixed",
                              "vertical": "hug"
                            }
                          },
                          "children": [
                            {
                              "id": "4:283",
                              "name": "Heading 2",
                              "type": "container",
                              "visible": true,
                              "width": 84.2874984741211,
                              "height": 20,
                              "x": 0,
                              "y": 0,
                              "layout": {
                                "mode": "vertical"
                              },
                              "layoutSelf": {
                                "align": "stretch",
                                "sizing": {
                                  "horizontal": "fill",
                                  "vertical": "hug"
                                }
                              },
                              "children": [
                                {
                                  "id": "4:284",
                                  "name": "Workforce",
                                  "type": "text",
                                  "visible": true,
                                  "width": 84,
                                  "height": 20,
                                  "x": 0,
                                  "y": 0,
                                  "layoutSelf": {
                                    "align": "auto",
                                    "sizing": {
                                      "horizontal": "hug",
                                      "vertical": "hug"
                                    }
                                  },
                                  "background": {
                                    "type": "solid",
                                    "value": "#000000"
                                  },
                                  "text": {
                                    "content": "Workforce",
                                    "fontFamily": "Inter",
                                    "fontSize": 16,
                                    "fontWeight": 900,
                                    "lineHeight": 20,
                                    "letterSpacing": -0.1599999964237213,
                                    "textAlign": "left",
                                    "verticalAlign": "top",
                                    "color": "#000000",
                                    "textDecoration": "none",
                                    "textTransform": "none"
                                  }
                                }
                              ]
                            },
                            {
                              "id": "4:285",
                              "name": "Paragraph",
                              "type": "container",
                              "visible": true,
                              "width": 84.2874984741211,
                              "height": 15,
                              "x": 0,
                              "y": 20,
                              "layout": {
                                "mode": "vertical"
                              },
                              "layoutSelf": {
                                "align": "stretch",
                                "sizing": {
                                  "horizontal": "fill",
                                  "vertical": "hug"
                                }
                              },
                              "children": [
                                {
                                  "id": "4:286",
                                  "name": "Hub v2.0",
                                  "type": "text",
                                  "visible": true,
                                  "width": 55,
                                  "height": 15,
                                  "x": 0,
                                  "y": 0,
                                  "layoutSelf": {
                                    "align": "auto",
                                    "sizing": {
                                      "horizontal": "hug",
                                      "vertical": "hug"
                                    }
                                  },
                                  "background": {
                                    "type": "solid",
                                    "value": "#525252"
                                  },
                                  "text": {
                                    "content": "Hub v2.0",
                                    "fontFamily": "Inter",
                                    "fontSize": 10,
                                    "fontWeight": 800,
                                    "lineHeight": 15,
                                    "letterSpacing": 1,
                                    "textAlign": "left",
                                    "verticalAlign": "top",
                                    "color": "#525252",
                                    "textDecoration": "none",
                                    "textTransform": "uppercase"
                                  }
                                }
                              ]
                            }
                          ]
                        }
                      ]
                    }
                  ]
                },
                {
                  "id": "4:287",
                  "name": "Navigation",
                  "type": "container",
                  "visible": true,
                  "width": 254.39999389648438,
                  "height": 575.7999877929688,
                  "x": 0,
                  "y": 90,
                  "layout": {
                    "mode": "vertical",
                    "padding": {
                      "top": 16,
                      "right": 16,
                      "bottom": 16,
                      "left": 16
                    }
                  },
                  "layoutSelf": {
                    "align": "stretch",
                    "flexGrow": 575.7999877929688,
                    "sizing": {
                      "horizontal": "fill",
                      "vertical": "fill"
                    }
                  },
                  "children": [
                    {
                      "id": "4:288",
                      "name": "Paragraph",
                      "type": "container",
                      "visible": true,
                      "width": 222.39999389648438,
                      "height": 15,
                      "x": 16,
                      "y": 16,
                      "layout": {
                        "mode": "vertical",
                        "padding": {
                          "top": 0,
                          "right": 8,
                          "bottom": 0,
                          "left": 8
                        }
                      },
                      "layoutSelf": {
                        "align": "stretch",
                        "sizing": {
                          "horizontal": "fill",
                          "vertical": "hug"
                        }
                      },
                      "children": [
                        {
                          "id": "4:289",
                          "name": "Menu",
                          "type": "text",
                          "visible": true,
                          "width": 33,
                          "height": 15,
                          "x": 8,
                          "y": 0,
                          "layoutSelf": {
                            "align": "auto",
                            "sizing": {
                              "horizontal": "hug",
                              "vertical": "hug"
                            }
                          },
                          "background": {
                            "type": "solid",
                            "value": "#525252"
                          },
                          "text": {
                            "content": "Menu",
                            "fontFamily": "Inter",
                            "fontSize": 10,
                            "fontWeight": 800,
                            "lineHeight": 15,
                            "letterSpacing": 1,
                            "textAlign": "left",
                            "verticalAlign": "top",
                            "color": "#525252",
                            "textDecoration": "none",
                            "textTransform": "uppercase"
                          }
                        }
                      ]
                    },
                    {
                      "id": "4:290",
                      "name": "Link (transform)",
                      "type": "container",
                      "visible": true,
                      "width": 222.39999389648438,
                      "height": 55,
                      "x": 16,
                      "y": 31,
                      "layout": {
                        "mode": "vertical",
                        "padding": {
                          "top": 8,
                          "right": 0,
                          "bottom": 0,
                          "left": 0
                        }
                      },
                      "layoutSelf": {
                        "align": "auto",
                        "sizing": {
                          "horizontal": "fixed",
                          "vertical": "fixed"
                        }
                      },
                      "children": [
                        {
                          "id": "4:291",
                          "name": "Link",
                          "type": "container",
                          "visible": true,
                          "width": 222,
                          "height": 47,
                          "x": 0,
                          "y": 6,
                          "layout": {
                            "mode": "horizontal",
                            "alignItems": "center",
                            "gap": 12,
                            "padding": {
                              "top": 12,
                              "right": 16,
                              "bottom": 12,
                              "left": 16
                            }
                          },
                          "layoutSelf": {
                            "align": "auto",
                            "sizing": {
                              "horizontal": "fixed",
                              "vertical": "fixed"
                            }
                          },
                          "background": {
                            "type": "solid",
                            "value": "#a7f3d0"
                          },
                          "border": {
                            "color": "#000000",
                            "width": 1.600000023841858,
                            "style": "solid",
                            "position": "inside"
                          },
                          "shadow": [
                            {
                              "type": "drop",
                              "color": "rgba(0, 0, 0, 1.00)",
                              "offsetX": 2,
                              "offsetY": 2,
                              "blur": 0,
                              "spread": 0
                            }
                          ],
                          "children": [
                            {
                              "id": "4:292",
                              "name": "Icon",
                              "type": "icon",
                              "visible": true,
                              "width": 16,
                              "height": 16,
                              "x": 18,
                              "y": 16,
                              "layoutSelf": {
                                "align": "auto",
                                "sizing": {
                                  "horizontal": "fixed",
                                  "vertical": "fixed"
                                }
                              },
                              "children": [
                                {
                                  "id": "4:293",
                                  "name": "Vector",
                                  "type": "icon",
                                  "visible": true,
                                  "width": 4.6666669845581055,
                                  "height": 6,
                                  "x": 2,
                                  "y": 2,
                                  "border": {
                                    "color": "#000000",
                                    "width": 1.6666667461395264,
                                    "style": "solid",
                                    "position": "center"
                                  }
                                },
                                {
                                  "id": "4:294",
                                  "name": "Vector",
                                  "type": "icon",
                                  "visible": true,
                                  "width": 4.6666669845581055,
                                  "height": 3.3333334922790527,
                                  "x": 9,
                                  "y": 2,
                                  "border": {
                                    "color": "#000000",
                                    "width": 1.6666667461395264,
                                    "style": "solid",
                                    "position": "center"
                                  }
                                },
                                {
                                  "id": "4:295",
                                  "name": "Vector",
                                  "type": "icon",
                                  "visible": true,
                                  "width": 4.6666669845581055,
                                  "height": 6,
                                  "x": 9,
                                  "y": 8,
                                  "border": {
                                    "color": "#000000",
                                    "width": 1.6666667461395264,
                                    "style": "solid",
                                    "position": "center"
                                  }
                                },
                                {
                                  "id": "4:296",
                                  "name": "Vector",
                                  "type": "icon",
                                  "visible": true,
                                  "width": 4.6666669845581055,
                                  "height": 3.3333334922790527,
                                  "x": 2,
                                  "y": 11,
                                  "border": {
                                    "color": "#000000",
                                    "width": 1.6666667461395264,
                                    "style": "solid",
                                    "position": "center"
                                  }
                                }
                              ]
                            },
                            {
                              "id": "4:297",
                              "name": "Dashboard",
                              "type": "text",
                              "visible": true,
                              "width": 102,
                              "height": 20,
                              "x": 46,
                              "y": 14,
                              "layoutSelf": {
                                "align": "auto",
                                "sizing": {
                                  "horizontal": "hug",
                                  "vertical": "hug"
                                }
                              },
                              "background": {
                                "type": "solid",
                                "value": "#000000"
                              },
                              "text": {
                                "content": "Dashboard",
                                "fontFamily": "Inter",
                                "fontSize": 14,
                                "fontWeight": 800,
                                "lineHeight": 20,
                                "letterSpacing": 1.399999976158142,
                                "textAlign": "left",
                                "verticalAlign": "top",
                                "color": "#000000",
                                "textDecoration": "none",
                                "textTransform": "uppercase"
                              }
                            }
                          ]
                        }
                      ]
                    },
                    {
                      "id": "4:298",
                      "name": "Link (margin)",
                      "type": "container",
                      "visible": true,
                      "width": 222.39999389648438,
                      "height": 59.20000076293945,
                      "x": 16,
                      "y": 86,
                      "layout": {
                        "mode": "vertical",
                        "padding": {
                          "top": 12,
                          "right": 0,
                          "bottom": 0,
                          "left": 0
                        }
                      },
                      "layoutSelf": {
                        "align": "stretch",
                        "sizing": {
                          "horizontal": "fill",
                          "vertical": "hug"
                        }
                      },
                      "children": [
                        {
                          "id": "4:299",
                          "name": "Link",
                          "type": "container",
                          "visible": true,
                          "width": 222.39999389648438,
                          "height": 47.20000076293945,
                          "x": 0,
                          "y": 12,
                          "layout": {
                            "mode": "horizontal",
                            "alignItems": "center",
                            "gap": 12,
                            "padding": {
                              "top": 12,
                              "right": 16,
                              "bottom": 12,
                              "left": 16
                            }
                          },
                          "layoutSelf": {
                            "align": "stretch",
                            "sizing": {
                              "horizontal": "fill",
                              "vertical": "fixed"
                            }
                          },
                          "border": {
                            "color": "#000000",
                            "width": 1.600000023841858,
                            "style": "solid",
                            "position": "inside"
                          },
                          "children": [
                            {
                              "id": "4:300",
                              "name": "Icon",
                              "type": "icon",
                              "visible": true,
                              "width": 16,
                              "height": 16,
                              "x": 18,
                              "y": 16,
                              "layoutSelf": {
                                "align": "auto",
                                "sizing": {
                                  "horizontal": "fixed",
                                  "vertical": "fixed"
                                }
                              },
                              "children": [
                                {
                                  "id": "4:301",
                                  "name": "Vector",
                                  "type": "icon",
                                  "visible": true,
                                  "width": 12,
                                  "height": 12,
                                  "x": 2,
                                  "y": 2,
                                  "border": {
                                    "color": "#000000",
                                    "width": 1.6666667461395264,
                                    "style": "solid",
                                    "position": "center"
                                  }
                                },
                                {
                                  "id": "4:302",
                                  "name": "Vector",
                                  "type": "icon",
                                  "visible": true,
                                  "width": 0,
                                  "height": 12,
                                  "x": 6,
                                  "y": 2,
                                  "border": {
                                    "color": "#000000",
                                    "width": 1.6666667461395264,
                                    "style": "solid",
                                    "position": "center"
                                  }
                                },
                                {
                                  "id": "4:303",
                                  "name": "Vector",
                                  "type": "icon",
                                  "visible": true,
                                  "width": 0,
                                  "height": 12,
                                  "x": 10,
                                  "y": 2,
                                  "border": {
                                    "color": "#000000",
                                    "width": 1.6666667461395264,
                                    "style": "solid",
                                    "position": "center"
                                  }
                                }
                              ]
                            },
                            {
                              "id": "4:304",
                              "name": "Kanban Board",
                              "type": "text",
                              "visible": true,
                              "width": 130,
                              "height": 20,
                              "x": 46,
                              "y": 14,
                              "layoutSelf": {
                                "align": "auto",
                                "sizing": {
                                  "horizontal": "hug",
                                  "vertical": "hug"
                                }
                              },
                              "background": {
                                "type": "solid",
                                "value": "#000000"
                              },
                              "text": {
                                "content": "Kanban Board",
                                "fontFamily": "Inter",
                                "fontSize": 14,
                                "fontWeight": 800,
                                "lineHeight": 20,
                                "letterSpacing": 1.399999976158142,
                                "textAlign": "left",
                                "verticalAlign": "top",
                                "color": "#000000",
                                "textDecoration": "none",
                                "textTransform": "uppercase"
                              }
                            }
                          ]
                        }
                      ]
                    }
                  ]
                },
                {
                  "id": "4:305",
                  "name": "Container",
                  "type": "container",
                  "visible": true,
                  "width": 254.40000915527344,
                  "height": 109.80000305175781,
                  "x": 0,
                  "y": 665,
                  "layout": {
                    "mode": "vertical",
                    "padding": {
                      "top": 16,
                      "right": 16,
                      "bottom": 16,
                      "left": 16
                    }
                  },
                  "layoutSelf": {
                    "align": "stretch",
                    "sizing": {
                      "horizontal": "fill",
                      "vertical": "hug"
                    }
                  },
                  "border": {
                    "color": "#000000",
                    "width": 1,
                    "style": "solid",
                    "position": "inside"
                  },
                  "children": [
                    {
                      "id": "4:306",
                      "name": "Container",
                      "type": "container",
                      "visible": true,
                      "width": 222.40000915527344,
                      "height": 76.20000457763672,
                      "x": 16,
                      "y": 18,
                      "layout": {
                        "mode": "vertical",
                        "padding": {
                          "top": 12,
                          "right": 12,
                          "bottom": 12,
                          "left": 12
                        }
                      },
                      "layoutSelf": {
                        "align": "stretch",
                        "sizing": {
                          "horizontal": "fill",
                          "vertical": "hug"
                        }
                      },
                      "background": {
                        "type": "solid",
                        "value": "#fde047"
                      },
                      "border": {
                        "color": "#000000",
                        "width": 1.600000023841858,
                        "style": "solid",
                        "position": "inside"
                      },
                      "shadow": [
                        {
                          "type": "drop",
                          "color": "rgba(0, 0, 0, 1.00)",
                          "offsetX": 2,
                          "offsetY": 2,
                          "blur": 0,
                          "spread": 0
                        }
                      ],
                      "children": [
                        {
                          "id": "4:307",
                          "name": "Paragraph",
                          "type": "container",
                          "visible": true,
                          "width": 195.20001220703125,
                          "height": 15,
                          "x": 14,
                          "y": 14,
                          "layout": {
                            "mode": "vertical"
                          },
                          "layoutSelf": {
                            "align": "stretch",
                            "sizing": {
                              "horizontal": "fill",
                              "vertical": "hug"
                            }
                          },
                          "children": [
                            {
                              "id": "4:308",
                              "name": "Tip",
                              "type": "text",
                              "visible": true,
                              "width": 19,
                              "height": 15,
                              "x": 0,
                              "y": 0,
                              "layoutSelf": {
                                "align": "auto",
                                "sizing": {
                                  "horizontal": "hug",
                                  "vertical": "hug"
                                }
                              },
                              "background": {
                                "type": "solid",
                                "value": "#000000"
                              },
                              "text": {
                                "content": "Tip",
                                "fontFamily": "Inter",
                                "fontSize": 10,
                                "fontWeight": 800,
                                "lineHeight": 15,
                                "letterSpacing": 1,
                                "textAlign": "left",
                                "verticalAlign": "top",
                                "color": "#000000",
                                "textDecoration": "none",
                                "textTransform": "uppercase"
                              }
                            }
                          ]
                        },
                        {
                          "id": "4:309",
                          "name": "Paragraph (margin)",
                          "type": "container",
                          "visible": true,
                          "width": 195.20001220703125,
                          "height": 34,
                          "x": 14,
                          "y": 29,
                          "layout": {
                            "mode": "vertical",
                            "padding": {
                              "top": 4,
                              "right": 0,
                              "bottom": 0,
                              "left": 0
                            }
                          },
                          "layoutSelf": {
                            "align": "stretch",
                            "sizing": {
                              "horizontal": "fill",
                              "vertical": "hug"
                            }
                          },
                          "children": [
                            {
                              "id": "4:310",
                              "name": "Paragraph",
                              "type": "container",
                              "visible": true,
                              "width": 195.1999969482422,
                              "height": 30,
                              "x": 0,
                              "y": 4,
                              "layoutSelf": {
                                "align": "stretch",
                                "sizing": {
                                  "horizontal": "fill",
                                  "vertical": "fixed"
                                }
                              },
                              "children": [
                                {
                                  "id": "4:311",
                                  "name": "Press ",
                                  "type": "text",
                                  "visible": true,
                                  "width": 34,
                                  "height": 15,
                                  "x": 0,
                                  "y": -1,
                                  "background": {
                                    "type": "solid",
                                    "value": "#000000"
                                  },
                                  "text": {
                                    "content": "Press ",
                                    "fontFamily": "Inter",
                                    "fontSize": 12,
                                    "fontWeight": 700,
                                    "lineHeight": 15,
                                    "letterSpacing": 0,
                                    "textAlign": "left",
                                    "verticalAlign": "top",
                                    "color": "#000000",
                                    "textDecoration": "none",
                                    "textTransform": "none"
                                  }
                                },
                                {
                                  "id": "4:312",
                                  "name": "Text",
                                  "type": "container",
                                  "visible": true,
                                  "width": 20.350000381469727,
                                  "height": 18.399999618530273,
                                  "x": 36,
                                  "y": -2,
                                  "background": {
                                    "type": "solid",
                                    "value": "#ffffff"
                                  },
                                  "border": {
                                    "color": "#000000",
                                    "width": 1.600000023841858,
                                    "style": "solid",
                                    "position": "inside"
                                  },
                                  "children": [
                                    {
                                      "id": "4:313",
                                      "name": "N",
                                      "type": "text",
                                      "visible": true,
                                      "width": 9,
                                      "height": 15,
                                      "x": 6,
                                      "y": 2,
                                      "background": {
                                        "type": "solid",
                                        "value": "#000000"
                                      },
                                      "text": {
                                        "content": "N",
                                        "fontFamily": "Inter",
                                        "fontSize": 12,
                                        "fontWeight": 700,
                                        "lineHeight": 15,
                                        "letterSpacing": 0,
                                        "textAlign": "left",
                                        "verticalAlign": "top",
                                        "color": "#000000",
                                        "textDecoration": "none",
                                        "textTransform": "none"
                                      }
                                    }
                                  ]
                                },
                                {
                                  "id": "4:314",
                                  "name": " to create a new task fast.",
                                  "type": "text",
                                  "visible": true,
                                  "width": 196,
                                  "height": 15,
                                  "x": 0,
                                  "y": -1,
                                  "background": {
                                    "type": "solid",
                                    "value": "#000000"
                                  },
                                  "text": {
                                    "content": " to create a new task fast.",
                                    "fontFamily": "Inter",
                                    "fontSize": 12,
                                    "fontWeight": 700,
                                    "lineHeight": 15,
                                    "letterSpacing": 0,
                                    "textAlign": "left",
                                    "verticalAlign": "top",
                                    "color": "#000000",
                                    "textDecoration": "none",
                                    "textTransform": "none"
                                  }
                                }
                              ]
                            }
                          ]
                        }
                      ]
                    }
                  ]
                }
              ]
            }
          ]
        }
      ]
    }
  ]
}
```

**Frame Details:**
- Name: `dashboard-1`
- Dimensions: 1151 × 1070px
- Layout: Flex vertical
- Total Elements: 239 (including nested children)
- Children: 1 direct children

## ⚠️ COMPLEX COMPOSITE DESIGN DETECTED

This design contains **small or intricate components** that are composed of many small parts (icons, badges, micro-layouts, etc.). Pay extra attention to:

1. **Precise Positioning**: Small elements (< 32px) must be positioned with pixel-perfect accuracy. Use exact `x` and `y` coordinates from the specification.
2. **Composite Icons/Graphics**: Some "images" are actually made up of multiple vector shapes or small elements layered together. Preserve their exact arrangement.
3. **Z-Index Ordering**: Respect the order of elements in the `children` array — earlier elements are below, later elements are on top.
4. **Micro-Spacing**: Tiny gaps (1-4px) between elements are intentional. Do NOT round or approximate these values.
5. **Grouped Elements**: Small parts that form a single visual unit should be wrapped in a container with `position: relative` and children use `position: absolute` with exact coordinates.
6. **Scale Accuracy**: Do not scale, resize, or "improve" small element sizes. Use the EXACT dimensions from the spec.

---

# Design Tokens

## Colors
| Token | Hex | Usage |
|-------|-----|-------|
| color-1 | #f9f8f6 | background |
| color-2 | #000000 | border |
| color-3 | #525252 | background |
| color-4 | #ffffff | background |
| color-5 | #fecdd3 | background |
| color-6 | #404040 | background |
| color-7 | #fde047 | background |
| color-8 | #818cf8 | background |
| color-9 | #a7f3d0 | background |
| color-10 | #f0efea | background |
| color-11 | #737373 | background |

## Typography
| Token | Font | Size | Weight | Line Height |
|-------|------|------|--------|-------------|
| text-1 | Inter | 12px | 800 | 16px |
| text-2 | Inter | 16px | 900 | 24px |
| text-3 | Inter | 36px | 900 | 39.599998474121094px |
| text-4 | Inter | 14px | 700 | 20px |
| text-5 | Inter | 10px | 800 | 13.33329963684082px |
| text-6 | Inter | 48px | 900 | 48px |
| text-7 | Inter | 10px | 900 | 15px |
| text-8 | Inter | 24px | 800 | 28.799999237060547px |
| text-9 | Inter | 14px | 800 | 20px |
| text-10 | Inter | 12px | 700 | 15px |

## Spacing Scale
4, 8, 12, 16, 20, 24, 32, 40, 256px

## Border Radii Scale
26843500px

---

# Assets

The following assets have been exported and saved locally:

| Asset | Type | Format | Path |
|-------|------|--------|------|
| Icon | icon | svg | pending |
| Vector | icon | svg | pending |
| Vector | icon | svg | pending |
| Icon | icon | svg | pending |
| Vector | icon | svg | pending |
| Vector | icon | svg | pending |
| Icon | icon | svg | pending |
| Vector | icon | svg | pending |
| Vector | icon | svg | pending |
| Vector | icon | svg | pending |
| Icon | icon | svg | pending |
| Vector | icon | svg | pending |
| Vector | icon | svg | pending |
| Icon | icon | svg | pending |
| Vector | icon | svg | pending |
| Menu | icon | svg | pending |
| Icon | icon | svg | pending |
| Vector | icon | svg | pending |
| Vector | icon | svg | pending |
| Vector | icon | svg | pending |
| Vector | icon | svg | pending |
| Icon | icon | svg | pending |
| Vector | icon | svg | pending |
| Vector | icon | svg | pending |
| Vector | icon | svg | pending |

Use these asset paths in your generated code. Reference them relative to the component file.

---

# Requirements

## 🎯 CRITICAL: 100% Design Fidelity

**The generated code MUST produce a UI that is visually IDENTICAL to the Figma design.** This means:

- **Every measurement is exact**: Do not round 17px to 16px, do not approximate 23px to 24px. Use the EXACT values from the specification.
- **Every color is exact**: Use the exact hex/rgba values provided. No "close enough" colors.
- **Every font property is exact**: Font family, size, weight, line-height, letter-spacing — all must match precisely.
- **Every spacing is exact**: Margins, padding, gaps between elements — pixel-perfect accuracy required.
- **Every shadow is exact**: Box shadows with correct offset, blur, spread, and color.
- **Every border is exact**: Border width, style, color, and radius — no approximations.

**If you compare a screenshot of your rendered code to the Figma design, they should be indistinguishable.**

## File Operations

**You must CREATE or EDIT files to implement this design:**
- If the file doesn't exist → CREATE a new file with the complete code
- If the file exists → EDIT/UPDATE the existing file to match the new design
- Always output complete, runnable code — not partial snippets
- Include ALL imports, exports, and type definitions needed

## General
- Production-quality, clean, readable code
- Proper component hierarchy matching the design structure
- Accessible (ARIA labels, semantic HTML, keyboard navigation where appropriate)
- No placeholder or TODO comments — everything must be fully implemented
- No approximations, estimates, or "close enough" values

## Layout Precision
- Implement auto-layout as CSS Flexbox (direction, gap, padding, alignment)
- For `layout.mode: "none"` (absolute positioning), use `position: absolute` with exact `top`/`left` values from `x`/`y` coordinates
- Respect sizing modes precisely:
  - `fixed`: Use exact pixel width/height
  - `hug`: Use `width: fit-content` or `width: auto`
  - `fill`: Use `flex: 1` or `width: 100%` (context-dependent)
- Preserve the EXACT gap values from `layout.gap`
- Preserve the EXACT padding values from `layout.padding`

## Handling Small & Composite Elements

When dealing with small elements (icons, badges, decorations) or composite designs made of many parts:

1. **Use exact coordinates**: Small elements with `x` and `y` values must be positioned using those exact coordinates
2. **Preserve layering**: The order of children in the JSON represents z-order. Maintain this stacking order in your code.
3. **Don't "optimize" small values**: If spacing is 3px, use 3px. Don't round to 4px for "cleaner" code.
4. **Group related small parts**: Wrap tightly-coupled small elements in a positioned container
5. **Icons and vectors**: If an icon is composed of multiple shapes, consider using the exported SVG asset or recreating the exact structure

## Vue Requirements
- Use Composition API with `<script setup lang="ts">`
- Proper TypeScript props with defaults
- Decompose into reusable sub-components where logical

## Tailwind CSS Requirements
- Use utility classes directly in markup
- **CRITICAL: Use arbitrary values `[Xpx]` for EXACT measurements** that don't match Tailwind defaults
  - Example: `w-[347px]` instead of rounding to `w-80` (320px)
  - Example: `gap-[13px]` instead of approximating to `gap-3` (12px)
  - Example: `text-[17px]` instead of rounding to `text-lg` (18px)
- Use arbitrary colors for exact hex values: `bg-[#1E40AF]`, `text-[#6B7280]`
- Group related utilities logically (layout → sizing → spacing → colors → typography)
- Use `@apply` sparingly, only for highly reused patterns
- For absolute positioning within flex containers, use `relative` parent + `absolute` children

## Responsive Design
- Mobile-first approach
- Breakpoints: 640px (sm), 768px (md), 1024px (lg), 1280px (xl)
- Stack layouts vertically on small screens where appropriate
- Maintain readability and touch targets
- **Note**: The design specification shows the desktop/base design. Adapt thoughtfully for smaller screens while preserving the design's visual intent.

---

# Expected Output

## 📁 FILE OPERATIONS REQUIRED

**CREATE or EDIT the following files to implement this design:**

### Primary Files:
1. **Component file** (`src/components/[ComponentName].vue`)
   - The main UI component with full implementation
   - Include ALL imports at the top
   - Include ALL TypeScript types/interfaces
   - Export the component properly

2. **Styles file** (if applicable)
   - For CSS Modules: `src/components/[ComponentName].module.css`
   - For Vanilla CSS: `src/components/[ComponentName].css`
   - Include ALL style rules needed to match the design exactly

3. **Type definitions** (if TypeScript and complex props)
   - `src/components/[ComponentName].types.ts` (optional, can be inline)

### File Output Format:

For EACH file, output a code block with the filepath on the first line as a comment:

```vue
// filepath: src/components/MyComponent.vue
import React from 'react';
// ... complete component code ...
```

```css
/* filepath: src/components/MyComponent.module.css */
.container {
  /* ... complete styles ... */
}
```

## Quality Checklist

Before finishing, verify your code meets these criteria:
- [ ] All dimensions match the spec exactly (no rounding)
- [ ] All colors match the spec exactly (use provided hex values)
- [ ] All spacing (padding, margin, gap) matches exactly
- [ ] All typography (font-family, size, weight, line-height) matches exactly
- [ ] All borders and shadows match exactly
- [ ] Small elements are positioned precisely
- [ ] Component hierarchy reflects the design structure
- [ ] Code is complete and runnable (no TODOs or placeholders)

## Do NOT Generate:
- Package installation commands or setup instructions
- Routing logic (unless explicitly shown in the design)
- API calls or data fetching logic
- Global state management
- Build configuration changes