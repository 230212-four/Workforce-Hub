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
  "id": "3:2",
  "name": "auth-sign_in",
  "width": 1166,
  "height": 775,
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
      "id": "3:3",
      "name": "LoginPage",
      "type": "container",
      "visible": true,
      "width": 1166.4000244140625,
      "height": 775.2000122070312,
      "x": 0,
      "y": 0,
      "layout": {
        "mode": "horizontal",
        "justifyContent": "center",
        "alignItems": "center",
        "padding": {
          "top": 48,
          "right": 16,
          "bottom": 48,
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
        "value": "#f9f8f6"
      },
      "children": [
        {
          "id": "3:4",
          "name": "Container",
          "type": "container",
          "visible": true,
          "width": 448,
          "height": 584.4000244140625,
          "x": 359,
          "y": 95,
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
              "id": "3:5",
              "name": "Container",
              "type": "container",
              "visible": true,
              "width": 448,
              "height": 40,
              "x": 0,
              "y": 0,
              "layout": {
                "mode": "horizontal",
                "justifyContent": "center",
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
                  "id": "3:6",
                  "name": "Container",
                  "type": "container",
                  "visible": true,
                  "width": 40,
                  "height": 40,
                  "x": 126,
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
                      "id": "3:7",
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
                  "id": "3:8",
                  "name": "Text",
                  "type": "container",
                  "visible": true,
                  "width": 143.22500610351562,
                  "height": 20,
                  "x": 178,
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
                      "id": "3:9",
                      "name": "Workforce Hub",
                      "type": "text",
                      "visible": true,
                      "width": 142,
                      "height": 20,
                      "x": 0,
                      "y": 1,
                      "background": {
                        "type": "solid",
                        "value": "#000000"
                      },
                      "text": {
                        "content": "Workforce Hub",
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
              "id": "3:10",
              "name": "Container (margin)",
              "type": "container",
              "visible": true,
              "width": 448,
              "height": 504.4000244140625,
              "x": 0,
              "y": 40,
              "layout": {
                "mode": "vertical",
                "padding": {
                  "top": 24,
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
                  "id": "3:11",
                  "name": "Container",
                  "type": "container",
                  "visible": true,
                  "width": 448,
                  "height": 480.4000244140625,
                  "x": 0,
                  "y": 24,
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
                      "offsetX": 6,
                      "offsetY": 6,
                      "blur": 0,
                      "spread": 0
                    }
                  ],
                  "children": [
                    {
                      "id": "3:12",
                      "name": "Heading 1",
                      "type": "container",
                      "visible": true,
                      "width": 380.79998779296875,
                      "height": 40,
                      "x": 34,
                      "y": 34,
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
                          "id": "3:13",
                          "name": "Welcome back.",
                          "type": "text",
                          "visible": true,
                          "width": 268,
                          "height": 40,
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
                            "content": "Welcome back.",
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
                      "id": "3:14",
                      "name": "Paragraph",
                      "type": "container",
                      "visible": true,
                      "width": 380.79998779296875,
                      "height": 28,
                      "x": 34,
                      "y": 74,
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
                          "id": "3:15",
                          "name": "Sign in to access your workspace.",
                          "type": "text",
                          "visible": true,
                          "width": 233,
                          "height": 20,
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
                            "value": "#404040"
                          },
                          "text": {
                            "content": "Sign in to access your workspace.",
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
                      "id": "3:16",
                      "name": "Form",
                      "type": "container",
                      "visible": true,
                      "width": 380.79998779296875,
                      "height": 271.6000061035156,
                      "x": 34,
                      "y": 102,
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
                        "align": "auto",
                        "sizing": {
                          "horizontal": "fixed",
                          "vertical": "hug"
                        }
                      },
                      "children": [
                        {
                          "id": "3:17",
                          "name": "Container",
                          "type": "container",
                          "visible": true,
                          "width": 380.8000183105469,
                          "height": 74.19999694824219,
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
                              "id": "3:18",
                              "name": "Label",
                              "type": "container",
                              "visible": true,
                              "width": 380.8000183105469,
                              "height": 23,
                              "x": 0,
                              "y": 0,
                              "layout": {
                                "mode": "vertical",
                                "padding": {
                                  "top": 0,
                                  "right": 0,
                                  "bottom": 8,
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
                                  "id": "3:19",
                                  "name": "Email",
                                  "type": "text",
                                  "visible": true,
                                  "width": 42,
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
                                    "content": "Email",
                                    "fontFamily": "Inter",
                                    "fontSize": 12,
                                    "fontWeight": 800,
                                    "lineHeight": 14.399999618530273,
                                    "letterSpacing": 0.9599999785423279,
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
                              "id": "3:20",
                              "name": "Email Input",
                              "type": "input",
                              "visible": true,
                              "width": 380.8000183105469,
                              "height": 51.20000076293945,
                              "x": 0,
                              "y": 23,
                              "layout": {
                                "mode": "vertical",
                                "justifyContent": "center",
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
                                  "id": "3:21",
                                  "name": "you@example.com",
                                  "type": "text",
                                  "visible": true,
                                  "width": 345.6000061035156,
                                  "height": 19,
                                  "x": 18,
                                  "y": 16,
                                  "layoutSelf": {
                                    "align": "stretch",
                                    "sizing": {
                                      "horizontal": "fill",
                                      "vertical": "hug"
                                    }
                                  },
                                  "background": {
                                    "type": "solid",
                                    "value": "#000000",
                                    "opacity": 0.5
                                  },
                                  "text": {
                                    "content": "you@example.com",
                                    "fontFamily": "Inter",
                                    "fontSize": 16,
                                    "fontWeight": 500,
                                    "lineHeight": 19.363636016845703,
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
                        },
                        {
                          "id": "3:22",
                          "name": "Container",
                          "type": "container",
                          "visible": true,
                          "width": 380.8000183105469,
                          "height": 114.19999694824219,
                          "x": 0,
                          "y": 106,
                          "layout": {
                            "mode": "vertical",
                            "padding": {
                              "top": 20,
                              "right": 0,
                              "bottom": 20,
                              "left": 0
                            }
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
                              "id": "3:23",
                              "name": "Label",
                              "type": "container",
                              "visible": true,
                              "width": 380.8000183105469,
                              "height": 23,
                              "x": 0,
                              "y": 20,
                              "layout": {
                                "mode": "vertical",
                                "padding": {
                                  "top": 0,
                                  "right": 0,
                                  "bottom": 8,
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
                                  "id": "3:24",
                                  "name": "Password",
                                  "type": "text",
                                  "visible": true,
                                  "width": 77,
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
                                    "content": "Password",
                                    "fontFamily": "Inter",
                                    "fontSize": 12,
                                    "fontWeight": 800,
                                    "lineHeight": 14.399999618530273,
                                    "letterSpacing": 0.9599999785423279,
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
                              "id": "3:25",
                              "name": "Password Input",
                              "type": "input",
                              "visible": true,
                              "width": 380.8000183105469,
                              "height": 51.20000076293945,
                              "x": 0,
                              "y": 43,
                              "layout": {
                                "mode": "vertical",
                                "justifyContent": "center",
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
                                  "id": "3:26",
                                  "name": "••••••••",
                                  "type": "text",
                                  "visible": true,
                                  "width": 345.6000061035156,
                                  "height": 19,
                                  "x": 18,
                                  "y": 16,
                                  "layoutSelf": {
                                    "align": "stretch",
                                    "sizing": {
                                      "horizontal": "fill",
                                      "vertical": "hug"
                                    }
                                  },
                                  "background": {
                                    "type": "solid",
                                    "value": "#000000",
                                    "opacity": 0.5
                                  },
                                  "text": {
                                    "content": "••••••••",
                                    "fontFamily": "Inter",
                                    "fontSize": 16,
                                    "fontWeight": 500,
                                    "lineHeight": 19.363636016845703,
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
                        },
                        {
                          "id": "3:27",
                          "name": "Button",
                          "type": "button",
                          "visible": true,
                          "width": 380.8000183105469,
                          "height": 51.20000076293945,
                          "x": 0,
                          "y": 220,
                          "layoutSelf": {
                            "align": "stretch",
                            "sizing": {
                              "horizontal": "fill",
                              "vertical": "fixed"
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
                              "id": "3:28",
                              "name": "Sign In",
                              "type": "text",
                              "visible": true,
                              "width": 69,
                              "height": 24,
                              "x": 156,
                              "y": 13,
                              "background": {
                                "type": "solid",
                                "value": "#000000"
                              },
                              "text": {
                                "content": "Sign In",
                                "fontFamily": "Inter",
                                "fontSize": 16,
                                "fontWeight": 800,
                                "lineHeight": 24,
                                "letterSpacing": 1.600000023841858,
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
                    },
                    {
                      "id": "3:29",
                      "name": "Container (margin)",
                      "type": "container",
                      "visible": true,
                      "width": 380.79998779296875,
                      "height": 73.60000610351562,
                      "x": 34,
                      "y": 373,
                      "layout": {
                        "mode": "vertical",
                        "padding": {
                          "top": 24,
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
                          "id": "3:30",
                          "name": "Container",
                          "type": "container",
                          "visible": true,
                          "width": 380.8000183105469,
                          "height": 49.60000228881836,
                          "x": 0,
                          "y": 24,
                          "layoutSelf": {
                            "align": "stretch",
                            "sizing": {
                              "horizontal": "fill",
                              "vertical": "fixed"
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
                              "id": "3:31",
                              "name": "Button",
                              "type": "button",
                              "visible": true,
                              "width": 177.3625030517578,
                              "height": 20,
                              "x": 102,
                              "y": 28,
                              "children": [
                                {
                                  "id": "3:32",
                                  "name": "No account yet? Sign up",
                                  "type": "text",
                                  "visible": true,
                                  "width": 169,
                                  "height": 20,
                                  "x": 5,
                                  "y": 1,
                                  "background": {
                                    "type": "solid",
                                    "value": "#000000"
                                  },
                                  "text": {
                                    "content": "No account yet? Sign up",
                                    "fontFamily": "Inter",
                                    "fontSize": 14,
                                    "fontWeight": 900,
                                    "lineHeight": 20,
                                    "letterSpacing": 0,
                                    "textAlign": "center",
                                    "verticalAlign": "top",
                                    "color": "#000000",
                                    "textDecoration": "underline",
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
            },
            {
              "id": "3:33",
              "name": "Paragraph",
              "type": "container",
              "visible": true,
              "width": 448,
              "height": 40,
              "x": 0,
              "y": 544,
              "layout": {
                "mode": "vertical",
                "alignItems": "center",
                "padding": {
                  "top": 24,
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
                  "id": "3:34",
                  "name": "© 2026 Workforce Hub — Get Stuff Done",
                  "type": "text",
                  "visible": true,
                  "width": 319,
                  "height": 16,
                  "x": 65,
                  "y": 24,
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
                    "content": "© 2026 Workforce Hub — Get Stuff Done",
                    "fontFamily": "Inter",
                    "fontSize": 12,
                    "fontWeight": 800,
                    "lineHeight": 16,
                    "letterSpacing": 1.2000000476837158,
                    "textAlign": "center",
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
}
```

**Frame Details:**
- Name: `auth-sign_in`
- Dimensions: 1166 × 775px
- Layout: Flex vertical
- Total Elements: 32 (including nested children)
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
| color-2 | #a7f3d0 | background |
| color-3 | #000000 | border |
| color-4 | #ffffff | background |
| color-5 | #404040 | background |
| color-6 | #818cf8 | background |
| color-7 | #525252 | background |

## Typography
| Token | Font | Size | Weight | Line Height |
|-------|------|------|--------|-------------|
| text-1 | Inter | 16px | 900 | 24px |
| text-2 | Inter | 14px | 800 | 20px |
| text-3 | Inter | 36px | 900 | 39.599998474121094px |
| text-4 | Inter | 14px | 700 | 20px |
| text-5 | Inter | 12px | 800 | 14.399999618530273px |
| text-6 | Inter | 16px | 500 | 19.363636016845703px |
| text-7 | Inter | 16px | 800 | 24px |
| text-8 | Inter | 14px | 900 | 20px |

## Spacing Scale
8, 12, 16, 20, 24, 32, 48px

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