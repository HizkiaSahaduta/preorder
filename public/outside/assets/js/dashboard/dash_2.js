try {


    /*
        ==============================
        |    @Options Charts Script   |
        ==============================
    */

    /*
        ======================================
            Visitor Statistics | Options
        ======================================
    */

    
    // Total Visits

    var spark1 = {
        chart: {
            id: 'unique-visits',
            group: 'sparks2',
            type: 'line',
            height: 80,
            sparkline: {
                enabled: true
            },
            dropShadow: {
                enabled: true,
                top: 1,
                left: 1,
                blur: 2,
                color: '#e2a03f',
                opacity: 0.7,
            }
        },
        series: [{
            data: [21, 9, 36, 12, 44, 25, 59, 41, 66, 25]
        }],
        stroke: {
          curve: 'smooth',
          width: 2,
        },
        markers: {
            size: 0
        },
        grid: {
          padding: {
            top: 35,
            bottom: 0,
            left: 40
          }
        },
        colors: ['#e2a03f'],
        tooltip: {
            x: {
                show: false
            },
            y: {
                title: {
                    formatter: function formatter(val) {
                        return '';
                    }
                }
            }
        },
        responsive: [{
            breakpoint: 1351,
            options: {
               chart: {
                  height: 95,
              },
              grid: {
                  padding: {
                    top: 35,
                    bottom: 0,
                    left: 0
                  }
              },
            },
        },
        {
            breakpoint: 1200,
            options: {
               chart: {
                  height: 80,
              },
              grid: {
                  padding: {
                    top: 35,
                    bottom: 0,
                    left: 40
                  }
              },
            },
        },
        {
            breakpoint: 576,
            options: {
               chart: {
                  height: 95,
              },
              grid: {
                  padding: {
                    top: 45,
                    bottom: 0,
                    left: 0
                  }
              },
            },
        }

        ]
    }

    // Paid Visits

    var spark2 = {
        chart: {
          id: 'total-users',
          group: 'sparks1',
          type: 'line',
          height: 80,
          sparkline: {
            enabled: true
          },
          dropShadow: {
            enabled: true,
            top: 3,
            left: 1,
            blur: 3,
            color: '#009688',
            opacity: 0.7,
          }
        },
        series: [{
          data: [22, 19, 30, 47, 32, 44, 34, 55, 41, 69]
        }],
        stroke: {
          curve: 'smooth',
          width: 2,
        },
        markers: {
          size: 0
        },
        grid: {
          padding: {
            top: 35,
            bottom: 0,
            left: 40
          }
        },
        colors: ['#009688'],
        tooltip: {
          x: {
            show: false
          },
          y: {
            title: {
              formatter: function formatter(val) {
                return '';
              }
            }
          }
        },
        responsive: [{
            breakpoint: 1351,
            options: {
               chart: {
                  height: 95,
              },
              grid: {
                  padding: {
                    top: 35,
                    bottom: 0,
                    left: 0
                  }
              },
            },
        },
        {
            breakpoint: 1200,
            options: {
               chart: {
                  height: 80,
              },
              grid: {
                  padding: {
                    top: 35,
                    bottom: 0,
                    left: 40
                  }
              },
            },
        },
        {
            breakpoint: 576,
            options: {
               chart: {
                  height: 95,
              },
              grid: {
                  padding: {
                    top: 35,
                    bottom: 0,
                    left: 0
                  }
              },
            },
        }
        ]
    }
    

    /*
        ===================================
            Unique Visitors | Options
        ===================================
    */

    var d_1options1 = {
      chart: {
          height: 350,
          type: 'bar',
          toolbar: {
            show: false,
          },
          dropShadow: {
              enabled: true,
              top: 1,
              left: 1,
              blur: 2,
              color: '#acb0c3',
              opacity: 0.7,
          }
      },
      colors: ['#5c1ac3', '#ffbb44'],
      plotOptions: {
          bar: {
              horizontal: false,
              columnWidth: '55%',
              endingShape: 'rounded'  
          },
      },
      dataLabels: {
          enabled: false
      },
      legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            fontSize: '14px',
            markers: {
              width: 10,
              height: 10,
            },
            itemMargin: {
              horizontal: 0,
              vertical: 8
            }
      },
      stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
      },
      series: [{
          name: 'Direct',
          data: [58, 44, 55, 57, 56, 61, 58, 63, 60, 66, 56, 63]
      }, {
          name: 'Organic',
          data: [91, 76, 85, 101, 98, 87, 105, 91, 114, 94, 66, 70]
      }],
      xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      },
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'light',
          type: 'vertical',
          shadeIntensity: 0.3,
          inverseColors: false,
          opacityFrom: 1,
          opacityTo: 0.8,
          stops: [0, 100]
        }
      },
      tooltip: {
          y: {
              formatter: function (val) {
                  return val
              }
          }
      }
    }

    /*
        ==============================
            Statistics | Options
        ==============================
    */

    // Followers

    var d_1options3 = {
      chart: {
        id: 'sparkline1',
        type: 'area',
        height: 160,
        sparkline: {
          enabled: true
        },
      },
      stroke: {
          curve: 'smooth',
          width: 2,
      },
      series: [{
        name: 'AmtOrder',
        data: [8650000.00, 46900000.00, 23225000.00, 57875000.00, 3200000.00, 18095000.00, 158080000.00, 92800000.00, 951200000.00, 181760000.00, 102808000.00, 264110000.00, 174000000.00, 183885000.00, 147108000.00, 499840000.00, 26355000.00, 232921000.00, 210352000.00, 44650000.00, 345709000.00, 17075000.00, 327120000.00, 39475000.00, 514878000.00, 828345000.00, 147680000.00, 83447000.00, 655655000.00, 327120000.00, 17525000.00, 29600000.00, 77840000.00, 12050000.00, 23100000.00, 10175000.00, 4450000.00, 2325000.00, 10225000.00, 520000.00, 812500.00, 45630000.00, 1007500.00, 877500.00, 650000.00, 130000.00, 1007500.00, 2567500.00, 552500.00, 6370000.00, 3250000.00, 2925000.00, 3477500.00, 292500.00, 1657500.00, 50635000.00, 877500.00, 260000.00, 487500.00, 325000.00, 2665000.00, 3282500.00, 4030000.00, 3607500.00, 357500.00, 2535000.00, 1040000.00, 292500.00, 5005000.00, 1072500.00, 2762500.00, 7950000.00, 17125000.00, 3152500.00, 5527200000.00, 3300000000.00, 8218400000.00, 18654300000.00, 1318200000.00, 451815000.00, 631800000.00, 387270000.00, 3295500000.00, 677250000.00, 947700000.00, 1318200000.00, 270900000.00, 252720000.00, 270900000.00, 263640000.00, 3518100000.00, 577250000.00, 5809050000.00, 5054400000.00, 234540000.00, 252720000.00, 346350000.00, 1677300000.00, 1666340000.00, 31636800000.00, 230900000.00, 988650000.00, 1663650000.00, 1895400000.00, 1290900000.00, 1922700000.00, 3204500000.00, 2243150000.00, 252720000.00, 406350000.00, 329550000.00, 586350000.00, 2763600000.00, 3163500000.00, 4382000000.00, 1666340000.00, 2145400000.00, 3845400000.00, 7622550000.00, 288625000.00, 1145500000.00, 2272800000.00, 1118200000.00, 1663650000.00, 3881850000.00, 7700000000.00, 14850000000.00, 2291000000.00]
      }],
      labels: ['COIL C  0.35 bmt x  1219 mm AS100 G300', 'COIL C  0.30 bmt x   914 mm AS100 G300', 'COIL C  0.45 bmt x   914 mm AS100 G550', 'COIL C  0.25 bmt x   914 mm AS100 G550', 'COIL C  0.25 bmt x  1219 mm AS100 G550', 'COIL C  0.35 bmt x   914 mm AS100 G550', 'COIL B2 0.20 bmt x  914 mm AS70 G300', 'COIL B2 0.25 bmt x  1219 mm AS100 G300', 'COIL B2 0.25 bmt x  914 mm AS100 G550', 'COIL B2 0.30 bmt x  914 mm AS100 G300', 'COIL B1 0.20 bmt x 914 mm AS70 G300', 'COIL B1 0.30 bmt x 914 mm AS100 G300', 'COIL B2 0.25 bmt x  1219 mm AS100 G550', 'COIL B1 0.25 bmt x 914 mm AS100 G300', 'COIL B1 0.25 bmt x 1219 mm AS100 G300', 'COIL B1 0.30 bmt x 1219 mm AS100 G300', 'COIL C  0.35 bmt x  1219 mm AS100 G550', 'COIL B1 0.25 bmt x 1219 mm AS100 G550', 'COIL B1 0.25 bmt x 1219 mm AS150 G550', 'COIL C  0.20 bmt x   914 mm AS 70 G550', 'COIL B1 0.25 bmt x 1219 mm AS70 G550', 'COIL C 0.25 bmt x  1219 mm AS70 G550', 'COIL B2 0.25 bmt x  1219 mm AS 70 G550', 'COIL C 0.30 bmt x  914 mm AS100 G550', 'COIL B1 0.25 bmt x 914 mm AS100 G550', 'COIL B1  0.30 bmt x 914 mm AS100 G550', 'COIL B2  0.30 bmt x 914 mm AS100 G550', 'COIL B1  0.25 bmt x 914 mm AS70 G300', 'COIL B1  0.25 bmt x 914 mm AS70 G550', 'COIL B2  0.25 bmt x 914 mm AS70 G550', 'COIL C  0.40 bmt x 1219 mm AS70 G550', 'COIL C  0.25 bmt x 914 mm AS70 G550', 'COIL B2  0.30 bmt x 914 mm AS70 G550', 'COIL C 0.30 bmt x 101.00 mm AS 100 G300', 'COIL C 0.35 bmt x 914.00 mm AS 100 G300', 'COIL C 0.40 bmt x 101.00 mm AS 70 G550', 'COIL C 0.40 bmt x 101.00 mm AS 100 G550', 'COIL C 0.65 bmt x 152.00 mm AS 100 G550', 'COIL C 0.70 bmt x 152.00 mm AS 100 G550', 'EC 100 0.40 bmt x  1219 mm AS100 G300', 'EC 70 0.20 bmt x 914 mm AS70 G300', 'EC 70 0.20 bmt x  914 mm AS70 G550', 'EC 100 0.25 bmt x  914 mm AS100 G300', 'EC 100 0.30 bmt x 914 mm AS100 G300', 'EC 100 0.35 bmt x  1219 mm AS100 G300', 'EC 100 0.30 bmt x  1219 mm AS100 G300', 'EC 150 0.30 bmt x  914 mm AS150 G550', 'EC 100 0.25 bmt x  1219 mm AS100 G300', 'EC 150 0.35 bmt x  1219 mm AS150 G300', 'EC 150 0.45 bmt x  914 mm AS150 G300', 'EC 100 0.40 bmt x  1219 mm AS100 G550', 'EC 100 0.30 bmt x  914 mm AS100 G550', 'EC 100 0.35 bmt x  914 mm AS100 G550', 'EC 100 0.45 bmt x  1219 mm AS100 G550', 'EC 150 0.40 bmt x  1219 mm AS150 G550', 'EC 100 0.25 bmt x   914 mm AS100 G550', 'EC 100 0.45 bmt x   914 mm AS100 G300', 'EC 70 0.20 bmt x 1219 mm AS70 G300', 'EC 150 0.35 bmt x 914 mm AS150 G550', 'EC 100 0.65 bmt x  1219 mm AS100 G550', 'EC 100 0.35 bmt x  1219 mm AS100 G550', 'EC 100 0.30 bmt x  1219 mm AS100 G550', 'EC 70 0.25 bmt x  1219 mm AS70 G550', 'EC 100 0.50 bmt x 1219 mm AS100 G300', 'EC 150 0.45 bmt x  914 mm AS150 G550', 'EC 150 0.35 bmt x  1219 mm AS150 G550', 'EC 100 0.40 bmt x 914 mm AS100 G550', 'EC 70 0.20 bmt x 1219 mm AS70 G550', 'EC 70 0.65 bmt x 1219 mm AS70 G550', 'EC 70 0.40 bmt x 1219 mm AS70 G550', 'EC 70 0.25 bmt x 914 mm AS70 G550', 'COIL C  0.25 bmt x 914 mm AS70 G300', 'COIL C  0.35 bmt x 1219 mm AS70 G550', 'EC  0.35 bmt x 1219 mm AS70 G550', 'ZINIUM® 70 0.20 bmt x 914 mm AS70 G300', 'ZINIUM® 100 0.70 bmt x  1219 mm AS100 G550', 'ZINIUM® 70 0.70 bmt x  1219 mm AS70 G550', 'ZINIUM® 70 0.20 bmt x  914 mm AS70 G550', 'ZINIUM® 100 0.25 bmt x  914 mm AS100 G300', 'ZINIUM® 100 0.30 bmt x 914 mm AS100 G300', 'ZINIUM® 100 0.35 bmt x  1219 mm AS100 G300', 'ZINIUM® 100 0.30 bmt x  1219 mm AS100 G300', 'ZINIUM® 100 0.25 bmt x  1219 mm AS100 G550', 'ZINIUM® 150 0.30 bmt x  914 mm AS150 G550', 'ZINIUM® 100 0.35 bmt x  914 mm AS100 G300', 'ZINIUM® 100 0.25 bmt x  1219 mm AS100 G300', 'ZINIUM® 150 0.30 bmt x  1219 mm AS150 G300', 'ZINIUM® 150 0.45 bmt x  914 mm AS150 G300', 'ZINIUM® 150 0.30 bmt x  914 mm AS150 G300', 'ZINIUM® 150 0.35 bmt x  914 mm AS150 G300', 'ZINIUM® 100 0.40 bmt x  1219 mm AS100 G550', 'ZINIUM® 100 0.45 bmt x  914 mm AS100 G550', 'ZINIUM® 100 0.30 bmt x  914 mm AS100 G550', 'ZINIUM® 100 0.35 bmt x  914 mm AS100 G550', 'ZINIUM® 100 0.40 bmt x  914 mm AS100 G300', 'ZINIUM® 150 0.45 bmt x  1219 mm AS150 G300', 'ZINIUM® 100 0.45 bmt x  1219 mm AS100 G550', 'ZINIUM® 100 0.60 bmt x  1219 mm AS100 G550', 'ZINIUM® 150 0.40 bmt x  1219 mm AS150 G550', 'ZINIUM® 100 0.25 bmt x   914 mm AS100 G550', 'ZINIUM® 100 0.45 bmt x   914 mm AS100 G300', 'ZINIUM® 150 0.35 bmt x 914 mm AS150 G550', 'ZINIUM® 100 0.65 bmt x  1219 mm AS100 G550', 'ZINIUM® 100 0.35 bmt x  1219 mm AS100 G550', 'ZINIUM® 100 0.30 bmt x  1219 mm AS100 G550', 'ZINIUM®  70 0.25 bmt x  914 mm AS70 G300', 'ZINIUM®  70 0.25 bmt x  1219 mm AS 70 G300', 'ZINIUM® 70 0.25 bmt x  1219 mm AS70 G550', 'ZINIUM® 150 0.45 bmt x  914 mm AS150 G550', 'ZINIUM® 150 0.30 bmt x  1219 mm AS150 G550', 'ZINIUM® 150 0.35 bmt x  1219 mm AS150 G550', 'ZINIUM® 100 0.40 bmt x 914 mm AS100 G550', 'ZINIUM® 70 0.20 bmt x 1219 mm AS70 G550', 'ZINIUM® 70 0.65 bmt x 1219 mm AS70 G550', 'ZINIUM® 70 0.40 bmt x 1219 mm AS70 G550', 'ZINIUM® 70 0.25 bmt x 914 mm AS70 G550', 'ZINIUM® 70 0.55 bmt x 1219 mm AS70 G550', 'ZINIUM® 100 0.35 bmt x 101.00 mm AS 100 G550', 'ZINIUM® 100 0.40 bmt x 101.00 mm AS 100 G550', 'ZINIUM® 100 0.45 bmt x 101.00 mm AS 100 G550', 'ZINIUM® 100 0.50 bmt x 152.00 mm AS 100 G550', 'ZINIUM® 100 0.55 bmt x 152.00 mm AS 100 G550', 'ZINIUM® 100 0.60 bmt x 152.00 mm AS 100 G550', 'ZINIUM® 100 0.65 bmt x 135.00 mm AS 100 G550', 'ZINIUM® 100 0.65 bmt x 152.00 mm AS 100 G550', 'ZINIUM® 100 0.70 bmt x 135.00 mm AS 100 G550', 'ZINIUM® 100 0.70 bmt x 152.00 mm AS 100 G550', 'ZINIUM® 70 0.35 bmt x 1219 mm AS70 G550'],
      yaxis: {
        min: 0
      },
      colors: ['#1b55e2'],
      tooltip: {
        x: {
          show: true,
        }
      },
      fill: {
          type:"gradient",
          gradient: {
              type: "vertical",
              shadeIntensity: 1,
              inverseColors: !1,
              opacityFrom: .40,
              opacityTo: .05,
              stops: [45, 100]
          }
      },
    }

    // Referral

    var d_1options4 = {
      chart: {
        id: 'sparkline1',
        type: 'area',
        height: 160,
        sparkline: {
          enabled: true
        },
      },
      stroke: {
          curve: 'smooth',
          width: 2,
      },
      series: [{
        name: 'Sales',
        data: [ 60, 28, 52, 38, 40, 36, 38]
      }],
      labels: ['1', '2', '3', '4', '5', '6', '7'],
      yaxis: {
        min: 0
      },
      colors: ['#e7515a'],
      tooltip: {
        x: {
          show: false,
        }
      },
      fill: {
          type:"gradient",
          gradient: {
              type: "vertical",
              shadeIntensity: 1,
              inverseColors: !1,
              opacityFrom: .40,
              opacityTo: .05,
              stops: [45, 100]
          }
      },
    }

    // Engagement Rate

    var d_1options5 = {
      chart: {
        id: 'sparkline1',
        type: 'area',
        height: 160,
        sparkline: {
          enabled: true
        },
      },
      stroke: {
          curve: 'smooth',
          width: 2,
      },
      fill: {
        opacity: 1,
      },
      series: [{
        name: 'Sales',
        data: [28, 50, 36, 60, 38, 52, 38 ]
      }],
      labels: ['1', '2', '3', '4', '5', '6', '7'],
      yaxis: {
        min: 0
      },
      colors: ['#8dbf42'],
      tooltip: {
        x: {
          show: false,
        }
      },
      fill: {
          type:"gradient",
          gradient: {
              type: "vertical",
              shadeIntensity: 1,
              inverseColors: !1,
              opacityFrom: .40,
              opacityTo: .05,
              stops: [45, 100]
          }
      },
    }

    


    /*
        ==============================
        |    @Render Charts Script    |
        ==============================
    */


    /*
        ======================================
            Visitor Statistics | Script
        ======================================
    */

    // Total Visits
    d_1C_1 = new ApexCharts(document.querySelector("#total-users"), spark1);
    d_1C_1.render();

    // Paid Visits
    d_1C_2 = new ApexCharts(document.querySelector("#paid-visits"), spark2);
    d_1C_2.render();

    /*
        ===================================
            Unique Visitors | Script
        ===================================
    */

    var d_1C_3 = new ApexCharts(
        document.querySelector("#uniqueVisits"),
        d_1options1
    );
    d_1C_3.render();

    /*
        ==============================
            Statistics | Script
        ==============================
    */


    // Followers

    var d_1C_5 = new ApexCharts(document.querySelector("#hybrid_followers"), d_1options3);
    d_1C_5.render()

    // Referral

    var d_1C_6 = new ApexCharts(document.querySelector("#hybrid_followers1"), d_1options4);
    d_1C_6.render()

    // Engagement Rate

    var d_1C_7 = new ApexCharts(document.querySelector("#hybrid_followers3"), d_1options5);
    d_1C_7.render()



  /*
      =============================================
          Perfect Scrollbar | Notifications
      =============================================
  */
  const ps = new PerfectScrollbar(document.querySelector('.mt-container'));


} catch(e) {
  // statements
  console.log(e);
}
