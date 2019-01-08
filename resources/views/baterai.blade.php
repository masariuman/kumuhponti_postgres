<!DOCTYPE html>
<!-- saved from url=(0016)http://localhost -->
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:ms="urn:schemas-microsoft-com:xslt" xmlns:bat="http://schemas.microsoft.com/battery/2012" xmlns:js="http://microsoft.com/kernel"><head><meta http-equiv="X-UA-Compatible" content="IE=edge"/><meta name="ReportUtcOffset" content="+7:00"/><title>Battery report</title><style type="text/css">
      body {
          font-family: Segoe UI Light;
          letter-spacing: 0.02em;
          background-color: #181818;
          color: #F0F0F0;
          margin-left: 5.5em;
      }

      h1 {
          color: #11D8E8;
          font-size: 42pt;
      }

      h2 {
          font-size: 15pt;
          color: #11EEF4;
          margin-top: 4em;
          margin-bottom: 0em;
          letter-spacing: 0.08em;
      }

      td {
          padding-left: 0.3em;
          padding-right: 0.3em;
      }

      .nobatts {
          font-family: Segoe UI Semibold;
          background: #272727;
          color: #ACAC60;
          font-size: 13pt;
          padding-left:0.4em;
          padding-right:0.4em;
          padding-top:0.3em;
          padding-bottom:0.3em;
      }

      .explanation {
          color: #777777;
          font-size: 12pt;
          margin-bottom: 1em;
      }

      .explanation2 {
          color: #777777;
          font-size: 12pt;
          margin-bottom: 0.1em;
      }

      table {
          border-width: 0;
          table-layout: fixed;
          font-family: Segoe UI Light;
          letter-spacing: 0.02em;
          background-color: #181818;
          color: #f0f0f0;
      }

      .even { background: #272727; }
      .odd { background: #1E1E1E; }
      .even.suspend { background: #1A1A28; }
      .odd.suspend { background: #1A1A2C; }

      thead {
          font-family: Segoe UI Semibold;
          font-size: 85%;
          color: #BCBCBC;
      }

      text {
          font-size: 12pt;
          font-family: Segoe UI Light;
          fill: #11EEF4;
      }

      .centered { text-align: center; }

      .label {
          font-family: Segoe UI Semibold;
          font-size: 85%;
          color: #BCBCBC;
      }

      .dc.even { background: #40182C; }
      .dc.odd { background: #30141F; }

      td.colBreak {
          padding: 0;
          width: 0.15em;
      }

      td.state { text-align: center; }

      td.hms {
          font-family: Segoe UI Symbol;
          text-align: right;
          padding-right: 3.4em;
      }

      td.dateTime { font-family: Segoe UI Symbol; }
      td.nullValue { text-align: center; }

      td.percent {
          font-family: Segoe UI Symbol;
          text-align: right;
          padding-right: 2.5em;
      }

      col:first-child { width: 13em; }
      col.col2 { width: 10.4em; }
      col.percent { width: 7.5em; }

      td.mw {
          text-align: right;
          padding-right: 2.5em;
      }

      td.acdc { text-align: center; }

      span.date {
          display: inline-block;
          width: 5.5em;
      }

      span.time {
          text-align: right;
          width: 4.2em;
          display: inline-block;
      }

      text { font-family: Segoe UI Symbol; }

      .noncontigbreak {
          height: 0.3em;
          background-color: #1A1A28;
      }
    </style><script type="text/javascript">
    // Formats a number using the current locale (to handle the 1000's separator).
    // The result is rounded so no decimal point is shown.
    function numberToLocaleString(value) {
        var localeString = Math.round(parseFloat(value + '')).toLocaleString();
        return localeString.substring(0, localeString.indexOf('.'));
    }

    function padLeft(number, length) {
        var str = '' + number;
        while (str.length < length) {
            str = '0' + str;
        }

        return str;
    }

    // Returns the number of milliseconds between 2 date-times represented as strings.
    function msBetween(startTime, endTime) {
        return startTime > endTime
               ? msBetween(endTime, startTime)
               : parseDateTime(endTime) - parseDateTime(startTime);
    }

    var dateFormat = /(\d{4})-(\d{2})-(\d{2})[T](\d{2}):(\d{2}):(\d{2})/

    // Parses a date-time string and returns a Date (i.e. number of milliseconds)
    function parseDateTime(value) {
        if (!value) {
            return 0;
        }

        var match = dateFormat.exec(value)
        if (!match) {
            return 0;
        }

        return Date.parse(match[1] + '/' + match[2] + '/' +
                          match[3] + ' ' + match[4] + ':' +
                          match[5] + ':' + match[6])
    }

    // Parses just the date portion of a date-time string and returns a Date
    // (i.e. number of milliseconds)
    function parseDate(value) {
        if (!value) {
            return 0;
        }

        var match = dateFormat.exec(value)
        if (!match) {
            return 0;
        }

        return Date.parse(match[1] + '/' + match[2] + '/' + match[3])
    }

    var durationFormat = /P((\d+)D)?T((\d+)H)?((\d+)M)?(\d+)S/

    // Convert a string of the form P10DT1H15M40S to a count of milliseconds
    function parseDurationToMs(value) {
        var match = durationFormat.exec(value)
        if (!match) {
            return 0
        }

        var days = parseInt(match[2] || '0');
        var hrs = parseInt(match[4] || '0');
        var mins = parseInt(match[6] || '0');
        var secs = parseInt(match[7] || '0');
        return ((((((days * 24) + hrs) * 60) + mins) * 60) +  secs) * 1000;
    }

    // Converts milliseconds to days
    function msToDays(ms) {
        return (ms / 1000 / 60 / 60 / 24);
    }

    function daysToMs(days) {
        return (days * 24 * 60 * 60 * 1000);
    }

    // Formats a number of milliseconds as h:mm:ss
    function formatDurationMs(value) {
        var ms = parseInt(value);
        var secs = ms / 1000;
        var mins = secs / 60;
        var hrs = Math.floor(mins / 60);
        mins = Math.floor(mins % 60);
        secs = Math.floor(secs % 60);
        return hrs + ':' + padLeft(mins,2) + ':' + padLeft(secs,2);
    }

    // Converts a millisecond timestamp to a day and month string
    // Note: dayOffset is forward from date.
    function dateToDayAndMonth(ms, dayOffset) {
        var adjustedDate = new Date(ms + (dayOffset * 24 * 60 * 60 * 1000));
        return padLeft(adjustedDate.getMonth() + 1, 2) + "-" +
               padLeft(adjustedDate.getDate(), 2);
    }

    // Takes a millisecond timestamp and returns a new millisecond timestamp
    // rounded down to the current day.
    function dateFloor(ms) {
        var dt = new Date(ms);
        return Date.parse(dt.getFullYear() + '/' + (dt.getMonth() + 1) + '/' + dt.getDate());
    }
    
    Timegraph = {
        axisTop: 9.5,
        axisRight: 24.5,
        axisBottom: 25.5,
        axisLeft: 25.5,
        ticks: 10,

        // Maximum number of 24 hour ticks for showing 12 and 6 hour ticks

        ticks12Hour: 8,
        ticks6Hour: 4,

        // Shading

        lineColor: "#B82830",
        shadingColor: "#4d1d35",

        precompute: function (graph) {
            var canvas = graph.canvas;
            var data = graph.data;
            var min = 0;
            var max = 0;

            graph.height = canvas.height - Timegraph.axisTop - Timegraph.axisBottom;
            graph.width = canvas.width - Timegraph.axisLeft - Timegraph.axisRight;
            for (var i = 0; i < data.length; i++) {
                data[i].t0 = parseDateTime(data[i].x0);
                data[i].t1 = parseDateTime(data[i].x1);

                if (i == 0) {
                    min = data[i].t0;
                    max = data[i].t1;
                }

                if (data[i].t0 < min) {
                    min = data[i].t0;
                }

                if (data[i].t1 > max) {
                    max = data[i].t1;
                }

                data[i].yy0 =
                    Timegraph.axisTop + graph.height - data[i].y0 * graph.height;

                data[i].yy1 =
                    Timegraph.axisTop + graph.height - data[i].y1 * graph.height;
            }

            if (graph.startTime != null) {
                graph.startMs = parseDateTime(graph.startTime);

            } else {
                graph.startMs = min;
            }

            graph.endMs = max;
            graph.durationMs = max - min;
        },

        drawFrame: function (graph) {
            var canvas = graph.canvas;
            var context = graph.context;

            graph.width =
                canvas.width - Timegraph.axisRight - Timegraph.axisLeft;

            graph.height =
                canvas.height - Timegraph.axisTop - Timegraph.axisBottom;

            context.beginPath();
            context.moveTo(Timegraph.axisLeft, Timegraph.axisTop);
            context.lineTo(Timegraph.axisLeft + graph.width,
                           Timegraph.axisTop);

            context.lineTo(Timegraph.axisLeft + graph.width,
                           Timegraph.axisTop + graph.height);

            context.lineTo(Timegraph.axisLeft,
                           Timegraph.axisTop + graph.height);

            context.lineTo(Timegraph.axisLeft, Timegraph.axisTop);
            context.strokeStyle = "#c0c0c0";
            context.stroke();
        },

        drawRange: function (graph) {
            var canvas = graph.canvas;
            var context = graph.context;

            context.font = "12pt Segoe UI";
            context.fillStyle = "#00b0f0";
            context.fillText("%", 0, Timegraph.axisTop + 5, Timegraph.axisLeft);

            var tickSpacing = graph.height / 10;
            var offset = Timegraph.axisTop + tickSpacing;
            var tickValue = 90;
            for (var i = 0; i < 9; i++) {
                context.beginPath();
                context.moveTo(Timegraph.axisLeft, offset);
                context.lineTo(Timegraph.axisLeft + graph.width,
                               offset);

                context.stroke();
                context.fillText(tickValue.toString(),
                                 0,
                                 offset + 5,
                                 Timegraph.axisLeft);

                offset += tickSpacing;
                tickValue -= 10;
            }
        },

        drawDomain: function (graph, start, end) {
            var canvas = graph.canvas;
            var context = graph.context;
            var data = graph.data;
            var duration = end - start;
            if ((end < start)) {
                return;
            }

            var startDay = dateFloor(start);
            var t0 = startDay;
            var t1 = dateFloor(end);
            var dayOffset = 0;
            if (start > t0) {
                t0 = t0 + daysToMs(1);
                dayOffset++;
            }

            if (t0 >= t1) {
                return;
            }

            var increment =
                Math.max(Math.floor((t1 - t0) / daysToMs(Timegraph.ticks)), 1);

            var incrementMs = daysToMs(increment);
            var spacing = (incrementMs / duration) * graph.width;
            var offset = (t0 - start) / duration;
            var ticksCount = Math.floor((t1 - t0) / incrementMs);
            for (offset = offset * graph.width + Timegraph.axisLeft;
                 offset < (graph.width + Timegraph.axisLeft);
                 offset += spacing) {

                context.beginPath();
                context.moveTo(offset, Timegraph.axisTop);
                context.lineTo(offset, Timegraph.axisTop + graph.height);
                context.stroke();
                context.fillText(dateToDayAndMonth(startDay, dayOffset),
                                 offset,
                                 Timegraph.axisTop + graph.height + 15,
                                 spacing);

                dayOffset += increment;
            }
        },

        plot: function (graph, start, end) {
            var canvas = graph.canvas;
            var context = graph.context
            var data = graph.data;

            if ((end < start)) {
                return;
            }

            var duration = end - start;
            Timegraph.drawDomain(graph, start, end);
            context.fillStyle = Timegraph.shadingColor;
            for (var i = 0; i < data.length - 1; i++) {
                if ((data[i].t0 < start) || (data[i].t0 > end) ||
                    (data[i].t1 > end)) {

                    continue;
                }

                var x1 = (data[i].t0 - start) / duration;
                x1 = x1 * graph.width + Timegraph.axisLeft;

                var x2 = (data[i].t1 - start) / duration;
                x2 = x2 * graph.width + Timegraph.axisLeft;

                context.globalAlpha = 0.3;
                context.fillRect(x1, Timegraph.axisTop, (x2 - x1), graph.height);
                context.globalAlpha = 1;
                context.beginPath();
                context.strokeStyle = Timegraph.lineColor;
                context.lineWidth = 1.5;
                context.moveTo(x1, data[i].yy0);
                context.lineTo(x2, data[i].yy1);
                context.stroke();
            }
        },

        draw: function (graph) {
            var canvas = document.getElementById(graph.element);
            if (canvas == null) {
                return;
            }

            var context = canvas.getContext('2d');
            if (context == null) {
                return;
            }

            graph.width = 0;
            graph.height = 0;
            graph.context = context;
            graph.canvas = canvas;

            Timegraph.precompute(graph);
            Timegraph.drawFrame(graph);
            Timegraph.drawRange(graph);
            Timegraph.plot(graph, graph.startMs, graph.endMs);
        }
    };
    
    drainGraphData = [
    { x0: "2018-10-21T17:03:00", x1: "2018-10-21T17:07:05", y0: 1.004204576785222, y1: 1.004204576785222 }, 
{ x0: "2018-10-22T05:46:08", x1: "2018-10-22T06:14:57", y0: 0.9039231938112999, y1: 0.41048487360132613 }, 
{ x0: "2018-10-22T06:14:57", x1: "2018-10-22T06:14:57", y0: 0.41048487360132613, y1: 0.41048487360132613 }, 
{ x0: "2018-10-22T07:56:56", x1: "2018-10-22T07:57:11", y0: 0.24354192568034258, y1: 0.2409172537643321 }, 
{ x0: "2018-10-22T07:57:11", x1: "2018-10-22T07:58:00", y0: 0.2409172537643321, y1: 0.23304323801630058 }, 
{ x0: "2018-10-22T10:02:00", x1: "2018-10-22T10:05:09", y0: 0.5779113137173643, y1: 0.5847492747617075 }, 
{ x0: "2018-10-22T11:07:33", x1: "2018-10-22T11:07:34", y0: 0.40730763917668183, y1: 0.40730763917668183 }, 
{ x0: "2018-10-22T11:07:34", x1: "2018-10-22T11:07:36", y0: 0.40730763917668183, y1: 0.40730763917668183 }, 
{ x0: "2018-10-22T12:41:56", x1: "2018-10-22T13:02:35", y0: 0.23829258184832158, y1: 0.4839756872496201 }, 
{ x0: "2018-10-22T13:02:41", x1: "2018-10-22T13:23:50", y0: 0.4839756872496201, y1: 0.6797900262467191 }, 
{ x0: "2018-10-22T13:43:00", x1: "2018-10-22T13:45:06", y0: 0.7454068241469817, y1: 0.7511396601740572 }, 
{ x0: "2018-10-22T15:47:00", x1: "2018-10-22T16:18:27", y0: 0.9401160381268131, y1: 0.8330570520790165 }, 
{ x0: "2018-10-22T16:18:29", x1: "2018-10-22T16:18:31", y0: 0.8325044895703827, y1: 0.8346456692913385 }, 
{ x0: "2018-10-22T16:47:00", x1: "2018-10-22T17:00:19", y0: 0.5958005249343832, y1: 0.7012708937698577 }, 
{ x0: "2018-10-22T17:00:30", x1: "2018-10-22T17:30:20", y0: 0.6482939632545932, y1: 0.7963116452548694 }, 
{ x0: "2018-10-22T17:30:20", x1: "2018-10-22T17:32:02", y0: 0.7963116452548694, y1: 0.772689598010775 }, 
{ x0: "2018-10-22T17:32:02", x1: "2018-10-22T17:32:02", y0: 0.772689598010775, y1: 0.772689598010775 }, 
{ x0: "2018-10-22T18:43:00", x1: "2018-10-22T19:06:11", y0: 0.868766404199475, y1: 0.9306534051664594 }, 
{ x0: "2018-10-22T19:06:19", x1: "2018-10-22T19:21:35", y0: 0.9275452410553944, y1: 0.9548280149191878 }, 
{ x0: "2018-10-22T19:23:55", x1: "2018-10-22T19:27:21", y0: 0.9149053736703965, y1: 0.929617350462771 }, 
{ x0: "2018-10-22T19:27:31", x1: "2018-10-22T19:37:21", y0: 0.9222958972233733, y1: 0.9516507804945434 }, 
{ x0: "2018-10-22T19:37:21", x1: "2018-10-22T19:43:00", y0: 0.9516507804945434, y1: 0.8466639038541235 }, 
{ x0: "2018-10-22T19:43:00", x1: "2018-10-22T19:43:46", y0: 0.8466639038541235, y1: 0.8330570520790165 }, 
{ x0: "2018-10-22T19:53:25", x1: "2018-10-22T19:59:58", y0: 0.2724133167564581, y1: 0.393148224892941 }, 
{ x0: "2018-10-23T10:33:00", x1: "2018-10-23T10:48:06", y0: 0.8786885245901639, y1: 0.8786885245901639 }, 
{ x0: "2018-10-23T10:52:27", x1: "2018-10-23T11:07:25", y0: 0.7233879781420764, y1: 0.8579234972677595 }, 
{ x0: "2018-10-23T11:07:25", x1: "2018-10-23T11:07:30", y0: 0.8579234972677595, y1: 0.8122404371584699 }, 
{ x0: "2018-10-23T11:07:30", x1: "2018-10-23T11:07:30", y0: 0.8122404371584699, y1: 0.8122404371584699 }, 
{ x0: "2018-10-23T12:53:39", x1: "2018-10-23T13:20:40", y0: 0.7674316939890711, y1: 0.6195628415300547 }, 
{ x0: "2018-10-23T13:20:40", x1: "2018-10-23T13:20:41", y0: 0.6195628415300547, y1: 0.6195628415300547 }, 
{ x0: "2018-10-23T15:00:34", x1: "2018-10-23T15:18:28", y0: 1.5507103825136612, y1: 1.5947540983606558 }, 
{ x0: "2018-10-23T15:18:28", x1: "2018-10-23T15:56:00", y0: 1.5947540983606558, y1: 0.9136612021857924 }, 
{ x0: "2018-10-23T16:13:51", x1: "2018-10-23T16:19:58", y0: 0.28000882612533095, y1: 0.40298617240364814 }, 
{ x0: "2018-10-23T20:39:23", x1: "2018-10-23T20:49:39", y0: 0.7423349056603774, y1: 0.7423349056603774 }, 
{ x0: "2018-10-23T20:49:39", x1: "2018-10-23T20:49:39", y0: 0.7423349056603774, y1: 0.7423349056603774 }, 
{ x0: "2018-10-23T20:49:39", x1: "2018-10-23T20:49:41", y0: 0.7423349056603774, y1: 0.6601808176100629 }, 
{ x0: "2018-10-23T20:49:41", x1: "2018-10-23T20:49:42", y0: 0.6601808176100629, y1: 0.6601808176100629 }, 
{ x0: "2018-10-23T23:08:00", x1: "2018-10-23T23:31:14", y0: 0.9148977987421384, y1: 1.0858883647798742 }, 
{ x0: "2018-10-23T23:31:14", x1: "2018-10-23T23:34:12", y0: 1.0858883647798742, y1: 1.0253537735849056 }, 
{ x0: "2018-10-23T23:34:12", x1: "2018-10-23T23:34:12", y0: 1.0253537735849056, y1: 1.0253537735849056 }, 
{ x0: "2018-10-24T08:29:52", x1: "2018-10-24T08:29:55", y0: 0.9454599056603774, y1: 0.9431996855345912 }, 
{ x0: "2018-10-24T08:29:55", x1: "2018-10-24T08:31:00", y0: 0.9431996855345912, y1: 0.9313089622641509 }, 
{ x0: "2018-10-24T08:31:00", x1: "2018-10-24T08:35:26", y0: 0.9313089622641509, y1: 0.8439465408805031 }, 
{ x0: "2018-10-24T08:35:26", x1: "2018-10-24T08:35:27", y0: 0.8439465408805031, y1: 0.8439465408805031 }, 
{ x0: "2018-10-24T09:58:00", x1: "2018-10-24T09:58:27", y0: 0.5951278092297135, y1: 0.6081660662206211 }, 
{ x0: "2018-10-24T09:58:30", x1: "2018-10-24T09:58:31", y0: 0.6043060559272603, y1: 0.6036198318751073 }, 
{ x0: "2018-10-24T09:58:35", x1: "2018-10-24T09:58:45", y0: 0.6016469377251673, y1: 0.6043060559272603 }, 

    ];
    
    function main() {
        Timegraph.draw({
            element: "drain-graph",
            data: drainGraphData,
            startTime: "2018-10-21T10:10:41",
            endTime: "2018-10-24T10:10:42",
        });
    }

    if (window.addEventListener != null) {
        window.addEventListener("load", main, false);

    } else if (window.attachEvent != null) {
        window.attachEvent("onload", main);
    }
    </script></head><body><h1>
      Battery report
    </h1><table style="margin-bottom: 6em;"><col/><tr><td class="label">
          COMPUTER NAME
        </td><td>DESKTOP-V63AN0K</td></tr><tr><td class="label">
          SYSTEM PRODUCT NAME
        </td><td>ASUSTeK COMPUTER INC. X456UF</td></tr><tr><td class="label">
          BIOS
        </td><td>X456UF.204 10/21/2015</td></tr><tr><td class="label">
          OS BUILD
        </td><td>17134.1.amd64fre.rs4_release.180410-1804</td></tr><tr><td class="label">
          PLATFORM ROLE
        </td><td>Mobile</td></tr><tr><td class="label">
          CONNECTED STANDBY
        </td><td>Not supported</td></tr><tr><td class="label">
          REPORT TIME
        </td><td class="dateTime"><span class="date">2018-10-24 </span><span class="time">10:10:42</span></td></tr></table><h2>
      Installed batteries
    </h2><div class="explanation">
      Information about each currently installed battery
    </div><table><colgroup><col style="width: 15em;"/><col style="width: 14em;"/></colgroup><thead><tr><td> </td><td>
                  BATTERY
                  1</td></tr></thead><tr><td><span class="label">NAME</span></td><td>ASUS Battery</td></tr><tr><td><span class="label">MANUFACTURER</span></td><td>ASUSTeK</td></tr><tr><td><span class="label">SERIAL NUMBER</span></td><td>
        -
      </td></tr><tr><td><span class="label">CHEMISTRY</span></td><td>LIon</td></tr><tr><td><span class="label">DESIGN CAPACITY</span></td><td>38,000 mWh
      </td></tr><tr style="height:0.4em;"></tr><tr><td><span class="label">FULL CHARGE CAPACITY</span></td><td>11,582 mWh
      </td></tr><tr><td><span class="label">CYCLE COUNT</span></td><td>841</td></tr></table><h2>Recent usage</h2><div class="explanation">
      Power states over the last 3 days
    </div><table><colgroup><col/><col class="col2"/><col style="width: 4.2em;"/><col class="percent"/><col style="width: 11em;"/></colgroup><thead><tr><td>
            START TIME
          </td><td class="centered">
            STATE
          </td><td class="centered">
            SOURCE
          </td><td colspan="2" class="centered">
            CAPACITY REMAINING
          </td></tr></thead><tr class="even  1"><td class="dateTime"><span class="date">2018-10-21 </span><span class="time">15:02:19</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">52 %
        </td><td class="mw">7,607 mWh
        </td></tr><tr class="odd dc 2"><td class="dateTime"><span class="date"> </span><span class="time">17:07:05</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">100 %
        </td><td class="mw">14,569 mWh
        </td></tr><tr class="even  3"><td class="dateTime"><span class="date"> </span><span class="time">17:15:13</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">88 %
        </td><td class="mw">12,707 mWh
        </td></tr><tr class="odd suspend 4"><td class="dateTime"><span class="date"> </span><span class="time">19:04:00</span></td><td class="state">
        Suspended
      </td><td class="acdc"></td><td class="percent">100 %
        </td><td class="mw">14,485 mWh
        </td></tr><tr class="even  5"><td class="dateTime"><span class="date"> </span><span class="time">19:28:03</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">80 %
        </td><td class="mw">11,612 mWh
        </td></tr><tr class="odd suspend 6"><td class="dateTime"><span class="date"> </span><span class="time">20:04:09</span></td><td class="state">
        Suspended
      </td><td class="acdc"></td><td class="percent">96 %
        </td><td class="mw">13,847 mWh
        </td></tr><tr class="even dc 7"><td class="dateTime"><span class="date">2018-10-22 </span><span class="time">05:46:08</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">90 %
        </td><td class="mw">13,087 mWh
        </td></tr><tr class="odd suspend 8"><td class="dateTime"><span class="date"> </span><span class="time">06:14:57</span></td><td class="state">
        Suspended
      </td><td class="acdc"></td><td class="percent">41 %
        </td><td class="mw">5,943 mWh
        </td></tr><tr class="even dc 9"><td class="dateTime"><span class="date"> </span><span class="time">07:56:56</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">24 %
        </td><td class="mw">3,526 mWh
        </td></tr><tr class="odd  10"><td class="dateTime"><span class="date"> </span><span class="time">07:59:01</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">21 %
        </td><td class="mw">3,062 mWh
        </td></tr><tr class="even suspend 11"><td class="dateTime"><span class="date"> </span><span class="time">08:49:30</span></td><td class="state">
        Suspended
      </td><td class="acdc"></td><td class="percent">65 %
        </td><td class="mw">9,363 mWh
        </td></tr><tr class="odd dc 12"><td class="dateTime"><span class="date"> </span><span class="time">08:58:24</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">64 %
        </td><td class="mw">9,203 mWh
        </td></tr><tr class="even  13"><td class="dateTime"><span class="date"> </span><span class="time">09:13:04</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">30 %
        </td><td class="mw">4,362 mWh
        </td></tr><tr class="odd dc 14"><td class="dateTime"><span class="date"> </span><span class="time">10:05:09</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">58 %
        </td><td class="mw">8,466 mWh
        </td></tr><tr class="even  15"><td class="dateTime"><span class="date"> </span><span class="time">10:57:01</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">13 %
        </td><td class="mw">1,869 mWh
        </td></tr><tr class="odd dc 16"><td class="dateTime"><span class="date"> </span><span class="time">11:07:34</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">41 %
        </td><td class="mw">5,897 mWh
        </td></tr><tr class="even suspend 17"><td class="dateTime"><span class="date"> </span><span class="time">11:07:36</span></td><td class="state">
        Suspended
      </td><td class="acdc"></td><td class="percent">41 %
        </td><td class="mw">5,897 mWh
        </td></tr><tr class="odd dc 18"><td class="dateTime"><span class="date"> </span><span class="time">12:41:12</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">21 %
        </td><td class="mw">3,093 mWh
        </td></tr><tr class="even  19"><td class="dateTime"><span class="date"> </span><span class="time">12:41:28</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">23 %
        </td><td class="mw">3,321 mWh
        </td></tr><tr class="odd dc 20"><td class="dateTime"><span class="date"> </span><span class="time">13:02:35</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">48 %
        </td><td class="mw">7,007 mWh
        </td></tr><tr class="even  21"><td class="dateTime"><span class="date"> </span><span class="time">13:02:41</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">48 %
        </td><td class="mw">7,007 mWh
        </td></tr><tr class="odd dc 22"><td class="dateTime"><span class="date"> </span><span class="time">13:23:50</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">68 %
        </td><td class="mw">9,842 mWh
        </td></tr><tr class="even  23"><td class="dateTime"><span class="date"> </span><span class="time">13:24:07</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">68 %
        </td><td class="mw">9,811 mWh
        </td></tr><tr class="odd dc 24"><td class="dateTime"><span class="date"> </span><span class="time">13:45:06</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">75 %
        </td><td class="mw">10,875 mWh
        </td></tr><tr class="even  25"><td class="dateTime"><span class="date"> </span><span class="time">14:03:31</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">37 %
        </td><td class="mw">5,335 mWh
        </td></tr><tr class="odd dc 26"><td class="dateTime"><span class="date"> </span><span class="time">16:18:27</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">83 %
        </td><td class="mw">12,061 mWh
        </td></tr><tr class="even  27"><td class="dateTime"><span class="date"> </span><span class="time">16:18:29</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">83 %
        </td><td class="mw">12,053 mWh
        </td></tr><tr class="odd dc 28"><td class="dateTime"><span class="date"> </span><span class="time">16:18:31</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">83 %
        </td><td class="mw">12,084 mWh
        </td></tr><tr class="even  29"><td class="dateTime"><span class="date"> </span><span class="time">16:38:14</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">17 %
        </td><td class="mw">2,409 mWh
        </td></tr><tr class="odd dc 30"><td class="dateTime"><span class="date"> </span><span class="time">17:00:19</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">70 %
        </td><td class="mw">10,153 mWh
        </td></tr><tr class="even  31"><td class="dateTime"><span class="date"> </span><span class="time">17:00:30</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">65 %
        </td><td class="mw">9,386 mWh
        </td></tr><tr class="odd dc 32"><td class="dateTime"><span class="date"> </span><span class="time">17:30:20</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">80 %
        </td><td class="mw">11,529 mWh
        </td></tr><tr class="even suspend 33"><td class="dateTime"><span class="date"> </span><span class="time">17:32:02</span></td><td class="state">
        Suspended
      </td><td class="acdc"></td><td class="percent">77 %
        </td><td class="mw">11,187 mWh
        </td></tr><tr class="odd  34"><td class="dateTime"><span class="date"> </span><span class="time">18:41:57</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">87 %
        </td><td class="mw">12,524 mWh
        </td></tr><tr class="even dc 35"><td class="dateTime"><span class="date"> </span><span class="time">19:06:11</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">93 %
        </td><td class="mw">13,474 mWh
        </td></tr><tr class="odd  36"><td class="dateTime"><span class="date"> </span><span class="time">19:06:19</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">93 %
        </td><td class="mw">13,429 mWh
        </td></tr><tr class="even dc 37"><td class="dateTime"><span class="date"> </span><span class="time">19:21:35</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">95 %
        </td><td class="mw">13,824 mWh
        </td></tr><tr class="odd  38"><td class="dateTime"><span class="date"> </span><span class="time">19:23:55</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">91 %
        </td><td class="mw">13,246 mWh
        </td></tr><tr class="even dc 39"><td class="dateTime"><span class="date"> </span><span class="time">19:27:21</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">93 %
        </td><td class="mw">13,459 mWh
        </td></tr><tr class="odd  40"><td class="dateTime"><span class="date"> </span><span class="time">19:27:31</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">92 %
        </td><td class="mw">13,353 mWh
        </td></tr><tr class="even dc 41"><td class="dateTime"><span class="date"> </span><span class="time">19:37:21</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">95 %
        </td><td class="mw">13,778 mWh
        </td></tr><tr class="odd  42"><td class="dateTime"><span class="date"> </span><span class="time">19:53:25</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">27 %
        </td><td class="mw">3,944 mWh
        </td></tr><tr class="even dc 43"><td class="dateTime"><span class="date"> </span><span class="time">19:59:58</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">39 %
        </td><td class="mw">5,692 mWh
        </td></tr><tr class="odd  44"><td class="dateTime"><span class="date"> </span><span class="time">20:02:38</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">32 %
        </td><td class="mw">4,681 mWh
        </td></tr><tr class="even suspend 45"><td class="dateTime"><span class="date"> </span><span class="time">20:42:00</span></td><td class="state">
        Suspended
      </td><td class="acdc"></td><td class="percent">62 %
        </td><td class="mw">8,952 mWh
        </td></tr><tr class="odd  46"><td class="dateTime"><span class="date"> </span><span class="time">21:28:49</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">48 %
        </td><td class="mw">5,312 mWh
        </td></tr><tr class="even suspend 47"><td class="dateTime"><span class="date"> </span><span class="time">23:45:57</span></td><td class="state">
        Suspended
      </td><td class="acdc"></td><td class="percent">104 %
        </td><td class="mw">11,407 mWh
        </td></tr><tr class="odd dc 48"><td class="dateTime"><span class="date">2018-10-23 </span><span class="time">07:31:16</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">64 %
        </td><td class="mw">7,014 mWh
        </td></tr><tr class="even  49"><td class="dateTime"><span class="date"> </span><span class="time">07:38:04</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">51 %
        </td><td class="mw">5,563 mWh
        </td></tr><tr class="odd suspend 50"><td class="dateTime"><span class="date"> </span><span class="time">08:28:00</span></td><td class="state">
        Suspended
      </td><td class="acdc"></td><td class="percent">72 %
        </td><td class="mw">7,858 mWh
        </td></tr><tr class="even  51"><td class="dateTime"><span class="date"> </span><span class="time">09:27:54</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">80 %
        </td><td class="mw">7,311 mWh
        </td></tr><tr class="odd dc 52"><td class="dateTime"><span class="date"> </span><span class="time">10:48:06</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">88 %
        </td><td class="mw">8,040 mWh
        </td></tr><tr class="even  53"><td class="dateTime"><span class="date"> </span><span class="time">10:52:27</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">72 %
        </td><td class="mw">6,619 mWh
        </td></tr><tr class="odd dc 54"><td class="dateTime"><span class="date"> </span><span class="time">11:07:25</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">86 %
        </td><td class="mw">7,850 mWh
        </td></tr><tr class="even suspend 55"><td class="dateTime"><span class="date"> </span><span class="time">11:07:30</span></td><td class="state">
        Suspended
      </td><td class="acdc"></td><td class="percent">81 %
        </td><td class="mw">7,432 mWh
        </td></tr><tr class="odd dc 56"><td class="dateTime"><span class="date"> </span><span class="time">12:53:39</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">77 %
        </td><td class="mw">7,022 mWh
        </td></tr><tr class="even suspend 57"><td class="dateTime"><span class="date"> </span><span class="time">13:20:41</span></td><td class="state">
        Suspended
      </td><td class="acdc"></td><td class="percent">62 %
        </td><td class="mw">5,669 mWh
        </td></tr><tr class="odd  58"><td class="dateTime"><span class="date"> </span><span class="time">13:48:03</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">108 %
        </td><td class="mw">9,902 mWh
        </td></tr><tr class="even dc 59"><td class="dateTime"><span class="date"> </span><span class="time">15:18:28</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">159 %
        </td><td class="mw">14,592 mWh
        </td></tr><tr class="odd suspend 60"><td class="dateTime"><span class="date"> </span><span class="time">15:56:00</span></td><td class="state">
        Suspended
      </td><td class="acdc"></td><td class="percent">91 %
        </td><td class="mw">8,360 mWh
        </td></tr><tr class="even  61"><td class="dateTime"><span class="date"> </span><span class="time">16:13:51</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">28 %
        </td><td class="mw">3,807 mWh
        </td></tr><tr class="odd dc 62"><td class="dateTime"><span class="date"> </span><span class="time">16:19:58</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">40 %
        </td><td class="mw">5,479 mWh
        </td></tr><tr class="even  63"><td class="dateTime"><span class="date"> </span><span class="time">16:21:03</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">29 %
        </td><td class="mw">3,967 mWh
        </td></tr><tr class="odd suspend 64"><td class="dateTime"><span class="date"> </span><span class="time">18:11:00</span></td><td class="state">
        Suspended
      </td><td class="acdc"></td><td class="percent">105 %
        </td><td class="mw">14,234 mWh
        </td></tr><tr class="even  65"><td class="dateTime"><span class="date"> </span><span class="time">19:05:26</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">42 %
        </td><td class="mw">4,263 mWh
        </td></tr><tr class="odd dc 66"><td class="dateTime"><span class="date"> </span><span class="time">20:49:39</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">74 %
        </td><td class="mw">7,554 mWh
        </td></tr><tr class="even suspend 67"><td class="dateTime"><span class="date"> </span><span class="time">20:49:42</span></td><td class="state">
        Suspended
      </td><td class="acdc"></td><td class="percent">66 %
        </td><td class="mw">6,718 mWh
        </td></tr><tr class="odd dc 68"><td class="dateTime"><span class="date"> </span><span class="time">22:03:36</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">63 %
        </td><td class="mw">6,429 mWh
        </td></tr><tr class="even  69"><td class="dateTime"><span class="date"> </span><span class="time">22:43:37</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">39 %
        </td><td class="mw">4,005 mWh
        </td></tr><tr class="odd dc 70"><td class="dateTime"><span class="date"> </span><span class="time">23:31:14</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">109 %
        </td><td class="mw">11,050 mWh
        </td></tr><tr class="even suspend 71"><td class="dateTime"><span class="date"> </span><span class="time">23:34:12</span></td><td class="state">
        Suspended
      </td><td class="acdc"></td><td class="percent">103 %
        </td><td class="mw">10,434 mWh
        </td></tr><tr class="odd dc 72"><td class="dateTime"><span class="date">2018-10-24 </span><span class="time">08:29:52</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">95 %
        </td><td class="mw">9,621 mWh
        </td></tr><tr class="even suspend 73"><td class="dateTime"><span class="date"> </span><span class="time">08:35:27</span></td><td class="state">
        Suspended
      </td><td class="acdc"></td><td class="percent">84 %
        </td><td class="mw">8,588 mWh
        </td></tr><tr class="odd  74"><td class="dateTime"><span class="date"> </span><span class="time">09:56:55</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">59 %
        </td><td class="mw">6,824 mWh
        </td></tr><tr class="even dc 75"><td class="dateTime"><span class="date"> </span><span class="time">09:58:27</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">61 %
        </td><td class="mw">7,090 mWh
        </td></tr><tr class="odd  76"><td class="dateTime"><span class="date"> </span><span class="time">09:58:30</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">60 %
        </td><td class="mw">7,045 mWh
        </td></tr><tr class="even dc 77"><td class="dateTime"><span class="date"> </span><span class="time">09:58:31</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">60 %
        </td><td class="mw">7,037 mWh
        </td></tr><tr class="odd  78"><td class="dateTime"><span class="date"> </span><span class="time">09:58:35</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">60 %
        </td><td class="mw">7,014 mWh
        </td></tr><tr class="even dc 79"><td class="dateTime"><span class="date"> </span><span class="time">09:58:45</span></td><td class="state">
        Active
      </td><td class="acdc">
        Battery
      </td><td class="percent">60 %
        </td><td class="mw">7,045 mWh
        </td></tr><tr class="odd  80"><td class="dateTime"><span class="date"> </span><span class="time">09:58:52</span></td><td class="state">
        Active
      </td><td class="acdc">
        AC
      </td><td class="percent">60 %
        </td><td class="mw">6,984 mWh
        </td></tr><tr class="even  81"><td class="dateTime"><span class="date"> </span><span class="time">10:10:41</span></td><td class="state">
        Report generated
      </td><td class="acdc">
        AC
      </td><td class="percent">71 %
        </td><td class="mw">8,284 mWh
        </td></tr></table><h2>Battery usage</h2><div class="explanation">
      Battery drains over the last 3 days
    </div><canvas id="drain-graph" width="864" height="400"></canvas><table><colgroup><col/><col class="col2"/><col style="width: 10em;"/><col class="percent"/><col style="width: 11em;"/></colgroup><thead><tr><td>
            START TIME
          </td><td class="centered">
            STATE
          </td><td class="centered">
            DURATION
          </td><td class="centered" colspan="2">
            ENERGY DRAINED
          </td></tr></thead><tr class="even dc 1"><td class="dateTime"><span class="date">2018-10-21 </span><span class="time">17:07:05</span></td><td class="state">
        Active
      </td><td class="hms">0:08:07</td><td class="percent">13 %
        </td><td class="mw">1,862 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="odd dc 2"><td class="dateTime"><span class="date">2018-10-22 </span><span class="time">05:46:08</span></td><td class="state">
        Active
      </td><td class="hms">0:28:49</td><td class="percent">49 %
        </td><td class="mw">7,144 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="even dc 3"><td class="dateTime"><span class="date"> </span><span class="time">07:56:56</span></td><td class="state">
        Active
      </td><td class="hms">0:02:04</td><td class="percent">3 %
        </td><td class="mw">464 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="odd dc 4"><td class="dateTime"><span class="date"> </span><span class="time">08:58:24</span></td><td class="state">
        Active
      </td><td class="hms">0:14:40</td><td class="percent">33 %
        </td><td class="mw">4,841 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="even dc 5"><td class="dateTime"><span class="date"> </span><span class="time">10:05:09</span></td><td class="state">
        Active
      </td><td class="hms">0:51:52</td><td class="percent">46 %
        </td><td class="mw">6,597 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="odd dc 6"><td class="dateTime"><span class="date"> </span><span class="time">11:07:34</span></td><td class="state">
        Active
      </td><td class="hms">0:00:02</td><td class="nullValue">-</td><td class="nullValue">-</td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="even dc 7"><td class="dateTime"><span class="date"> </span><span class="time">12:41:12</span></td><td class="state">
        Active
      </td><td class="hms">0:00:16</td><td class="nullValue">-</td><td class="mw">-228 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="odd dc 8"><td class="dateTime"><span class="date"> </span><span class="time">13:02:35</span></td><td class="state">
        Active
      </td><td class="hms">0:00:06</td><td class="nullValue">-</td><td class="nullValue">-</td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="even dc 9"><td class="dateTime"><span class="date"> </span><span class="time">13:23:50</span></td><td class="state">
        Active
      </td><td class="hms">0:00:16</td><td class="nullValue">-</td><td class="mw">31 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="odd dc 10"><td class="dateTime"><span class="date"> </span><span class="time">13:45:06</span></td><td class="state">
        Active
      </td><td class="hms">0:18:25</td><td class="percent">38 %
        </td><td class="mw">5,540 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="even dc 11"><td class="dateTime"><span class="date"> </span><span class="time">16:18:27</span></td><td class="state">
        Active
      </td><td class="hms">0:00:01</td><td class="nullValue">-</td><td class="mw">8 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="odd dc 12"><td class="dateTime"><span class="date"> </span><span class="time">16:18:31</span></td><td class="state">
        Active
      </td><td class="hms">0:19:43</td><td class="percent">67 %
        </td><td class="mw">9,675 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="even dc 13"><td class="dateTime"><span class="date"> </span><span class="time">17:00:19</span></td><td class="state">
        Active
      </td><td class="hms">0:00:10</td><td class="percent">5 %
        </td><td class="mw">767 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="odd dc 14"><td class="dateTime"><span class="date"> </span><span class="time">17:30:20</span></td><td class="state">
        Active
      </td><td class="hms">0:01:42</td><td class="percent">2 %
        </td><td class="mw">342 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="even dc 15"><td class="dateTime"><span class="date"> </span><span class="time">19:06:11</span></td><td class="state">
        Active
      </td><td class="hms">0:00:08</td><td class="nullValue">-</td><td class="mw">45 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="odd dc 16"><td class="dateTime"><span class="date"> </span><span class="time">19:21:35</span></td><td class="state">
        Active
      </td><td class="hms">0:02:20</td><td class="percent">4 %
        </td><td class="mw">578 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="even dc 17"><td class="dateTime"><span class="date"> </span><span class="time">19:27:21</span></td><td class="state">
        Active
      </td><td class="hms">0:00:10</td><td class="percent">1 %
        </td><td class="mw">106 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="odd dc 18"><td class="dateTime"><span class="date"> </span><span class="time">19:37:21</span></td><td class="state">
        Active
      </td><td class="hms">0:16:04</td><td class="percent">68 %
        </td><td class="mw">9,834 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="even dc 19"><td class="dateTime"><span class="date"> </span><span class="time">19:59:58</span></td><td class="state">
        Active
      </td><td class="hms">0:02:39</td><td class="percent">7 %
        </td><td class="mw">1,011 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="odd dc 20"><td class="dateTime"><span class="date">2018-10-23 </span><span class="time">07:31:16</span></td><td class="state">
        Active
      </td><td class="hms">0:06:47</td><td class="percent">13 %
        </td><td class="mw">1,451 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="even dc 21"><td class="dateTime"><span class="date"> </span><span class="time">10:48:06</span></td><td class="state">
        Active
      </td><td class="hms">0:04:20</td><td class="percent">16 %
        </td><td class="mw">1,421 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="odd dc 22"><td class="dateTime"><span class="date"> </span><span class="time">11:07:25</span></td><td class="state">
        Active
      </td><td class="hms">0:00:04</td><td class="percent">5 %
        </td><td class="mw">418 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="even dc 23"><td class="dateTime"><span class="date"> </span><span class="time">12:53:39</span></td><td class="state">
        Active
      </td><td class="hms">0:27:01</td><td class="percent">15 %
        </td><td class="mw">1,353 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="odd dc 24"><td class="dateTime"><span class="date"> </span><span class="time">15:18:28</span></td><td class="state">
        Active
      </td><td class="hms">0:37:31</td><td class="percent">68 %
        </td><td class="mw">6,232 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="even dc 25"><td class="dateTime"><span class="date"> </span><span class="time">16:19:58</span></td><td class="state">
        Active
      </td><td class="hms">0:01:05</td><td class="percent">11 %
        </td><td class="mw">1,512 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="odd dc 26"><td class="dateTime"><span class="date"> </span><span class="time">20:49:39</span></td><td class="state">
        Active
      </td><td class="hms">0:00:02</td><td class="percent">8 %
        </td><td class="mw">836 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="even dc 27"><td class="dateTime"><span class="date"> </span><span class="time">22:03:36</span></td><td class="state">
        Active
      </td><td class="hms">0:40:00</td><td class="percent">24 %
        </td><td class="mw">2,424 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="odd dc 28"><td class="dateTime"><span class="date"> </span><span class="time">23:31:14</span></td><td class="state">
        Active
      </td><td class="hms">0:02:58</td><td class="percent">6 %
        </td><td class="mw">616 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="even dc 29"><td class="dateTime"><span class="date">2018-10-24 </span><span class="time">08:29:52</span></td><td class="state">
        Active
      </td><td class="hms">0:05:34</td><td class="percent">10 %
        </td><td class="mw">1,033 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="odd dc 30"><td class="dateTime"><span class="date"> </span><span class="time">09:58:27</span></td><td class="state">
        Active
      </td><td class="hms">0:00:02</td><td class="nullValue">-</td><td class="mw">45 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="even dc 31"><td class="dateTime"><span class="date"> </span><span class="time">09:58:31</span></td><td class="state">
        Active
      </td><td class="hms">0:00:04</td><td class="nullValue">-</td><td class="mw">23 mWh
        </td></tr><tr class="noncontigbreak"><td colspan="5"> </td></tr><tr class="odd dc 32"><td class="dateTime"><span class="date"> </span><span class="time">09:58:45</span></td><td class="state">
        Active
      </td><td class="hms">0:00:07</td><td class="percent">1 %
        </td><td class="mw">61 mWh
        </td></tr></table><h2>
      Usage history
    </h2><div class="explanation2">
      History of system usage on AC and battery
    </div><table><colgroup><col/><col class="col2"/><col style="width: 10em;"/><col style=""/><col style="width: 10em;"/><col style="width: 10em;"/><col style=""/></colgroup><thead><tr><td> </td><td colspan="2" class="centered">
            BATTERY DURATION
          </td><td class="colBreak"> </td><td colspan="3" class="centered">
            AC DURATION
          </td></tr><tr><td>
            PERIOD
          </td><td class="centered">
            ACTIVE
          </td><td class="centered">
            CONNECTED STANDBY
          </td><td class="colBreak"> </td><td class="centered">
            ACTIVE
          </td><td class="centered">
            CONNECTED STANDBY
          </td></tr></thead><tr class="even  1"><td class="dateTime">2018-03-05
      - 2018-03-12</td><td class="hms">20:11:30</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">32:28:07</td><td class="nullValue">-</td></tr><tr class="odd  2"><td class="dateTime">2018-03-12
      - 2018-04-09</td><td class="hms">90:18:54</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">137:13:53</td><td class="nullValue">-</td></tr><tr class="even  3"><td class="dateTime">2018-04-09
      - 2018-04-16</td><td class="hms">23:59:11</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">30:00:40</td><td class="nullValue">-</td></tr><tr class="odd  4"><td class="dateTime">2018-04-16
      - 2018-04-23</td><td class="hms">19:40:14</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">30:28:15</td><td class="nullValue">-</td></tr><tr class="even  5"><td class="dateTime">2018-04-23
      - 2018-04-30</td><td class="hms">26:30:44</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">40:49:41</td><td class="nullValue">-</td></tr><tr class="odd  6"><td class="dateTime">2018-04-30
      - 2018-05-07</td><td class="hms">45:21:11</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">68:25:08</td><td class="nullValue">-</td></tr><tr class="even  7"><td class="dateTime">2018-05-07
      - 2018-05-14</td><td class="hms">72:02:05</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">107:19:01</td><td class="nullValue">-</td></tr><tr class="odd  8"><td class="dateTime">2018-05-14
      - 2018-05-21</td><td class="hms">19:27:02</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">31:47:29</td><td class="nullValue">-</td></tr><tr class="even  9"><td class="dateTime">2018-05-21
      - 2018-05-28</td><td class="hms">180:21:48</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">279:27:51</td><td class="nullValue">-</td></tr><tr class="odd  10"><td class="dateTime">2018-05-28
      - 2018-06-04</td><td class="hms">14:08:49</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">22:26:42</td><td class="nullValue">-</td></tr><tr class="even  11"><td class="dateTime">2018-06-04
      - 2018-06-11</td><td class="hms">19:44:44</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">41:25:58</td><td class="nullValue">-</td></tr><tr class="odd  12"><td class="dateTime">2018-06-11
      - 2018-06-18</td><td class="hms">4:22:09</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">6:14:10</td><td class="nullValue">-</td></tr><tr class="even  13"><td class="dateTime">2018-06-18
      - 2018-06-25</td><td class="hms">6:51:05</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">7:25:55</td><td class="nullValue">-</td></tr><tr class="odd  14"><td class="dateTime">2018-06-25
      - 2018-07-02</td><td class="hms">14:15:54</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">22:06:54</td><td class="nullValue">-</td></tr><tr class="even  15"><td class="dateTime">2018-07-02
      - 2018-07-09</td><td class="hms">40:19:15</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">56:57:04</td><td class="nullValue">-</td></tr><tr class="odd  16"><td class="dateTime">2018-07-09
      - 2018-07-16</td><td class="hms">18:49:11</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">38:18:20</td><td class="nullValue">-</td></tr><tr class="even  17"><td class="dateTime">2018-07-16
      - 2018-07-23</td><td class="hms">15:21:17</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">21:47:23</td><td class="nullValue">-</td></tr><tr class="odd  18"><td class="dateTime">2018-07-23
      - 2018-07-30</td><td class="hms">19:05:41</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">38:21:08</td><td class="nullValue">-</td></tr><tr class="even  19"><td class="dateTime">2018-07-30
      - 2018-08-06</td><td class="hms">17:51:56</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">35:31:59</td><td class="nullValue">-</td></tr><tr class="odd  20"><td class="dateTime">2018-08-06
      - 2018-08-13</td><td class="hms">22:07:45</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">58:35:36</td><td class="nullValue">-</td></tr><tr class="even  21"><td class="dateTime">2018-08-13
      - 2018-08-20</td><td class="hms">16:47:25</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">30:37:41</td><td class="nullValue">-</td></tr><tr class="odd  22"><td class="dateTime">2018-08-20
      - 2018-08-27</td><td class="hms">4:13:58</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">12:56:33</td><td class="nullValue">-</td></tr><tr class="even  23"><td class="dateTime">2018-08-27
      - 2018-09-03</td><td class="hms">19:35:04</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">45:34:56</td><td class="nullValue">-</td></tr><tr class="odd  24"><td class="dateTime">2018-09-03
      - 2018-09-10</td><td class="hms">27:54:00</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">64:57:54</td><td class="nullValue">-</td></tr><tr class="even  25"><td class="dateTime">2018-09-10
      - 2018-09-17</td><td class="hms">11:41:38</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">25:12:03</td><td class="nullValue">-</td></tr><tr class="odd  26"><td class="dateTime">2018-09-17
      - 2018-09-24</td><td class="hms">18:14:49</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">38:40:45</td><td class="nullValue">-</td></tr><tr class="even  27"><td class="dateTime">2018-09-24
      - 2018-10-01</td><td class="hms">11:40:32</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">30:45:49</td><td class="nullValue">-</td></tr><tr class="odd  28"><td class="dateTime">2018-10-01
      - 2018-10-08</td><td class="hms">21:27:33</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">48:29:06</td><td class="nullValue">-</td></tr><tr class="even  29"><td class="dateTime">2018-10-08
      - 2018-10-15</td><td class="hms">11:40:31</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">36:04:17</td><td class="nullValue">-</td></tr><tr class="odd  30"><td class="dateTime">2018-10-15</td><td class="hms">2:51:00</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">7:18:57</td><td class="nullValue">-</td></tr><tr class="even  31"><td class="dateTime">2018-10-16</td><td class="hms">0:40:34</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">0:19:23</td><td class="nullValue">-</td></tr><tr class="odd  32"><td class="dateTime">2018-10-17</td><td class="hms">0:45:32</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">10:41:48</td><td class="nullValue">-</td></tr><tr class="even  33"><td class="dateTime">2018-10-18</td><td class="hms">1:41:25</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">6:33:14</td><td class="nullValue">-</td></tr><tr class="odd  34"><td class="dateTime">2018-10-19</td><td class="hms">0:06:32</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">5:43:57</td><td class="nullValue">-</td></tr><tr class="even  35"><td class="dateTime">2018-10-20</td><td class="nullValue">-</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="nullValue">-</td><td class="nullValue">-</td></tr><tr class="odd  36"><td class="dateTime">2018-10-21</td><td class="hms">0:08:07</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">4:29:34</td><td class="nullValue">-</td></tr><tr class="even  37"><td class="dateTime">2018-10-22</td><td class="hms">2:39:22</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">9:58:32</td><td class="nullValue">-</td></tr><tr class="odd  38"><td class="dateTime">2018-10-23</td><td class="hms">1:59:47</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">7:11:47</td><td class="nullValue">-</td></tr></table><h2>
      Battery capacity history
    </h2><div class="explanation">
      Charge capacity history of the system's batteries
    </div><table><colgroup><col/><col class="col2"/><col style="width: 10em;"/></colgroup><thead><tr><td><span>PERIOD</span></td><td class="centered">
            FULL CHARGE CAPACITY
          </td><td class="centered">
            DESIGN CAPACITY
          </td></tr></thead><tr class="even  1"><td class="dateTime">2018-03-05
      - 2018-03-12</td><td class="mw">28,217 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="odd  2"><td class="dateTime">2018-03-12
      - 2018-04-09</td><td class="mw">28,067 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="even  3"><td class="dateTime">2018-04-09
      - 2018-04-16</td><td class="mw">28,167 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="odd  4"><td class="dateTime">2018-04-16
      - 2018-04-23</td><td class="mw">27,663 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="even  5"><td class="dateTime">2018-04-23
      - 2018-04-30</td><td class="mw">27,280 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="odd  6"><td class="dateTime">2018-04-30
      - 2018-05-07</td><td class="mw">27,325 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="even  7"><td class="dateTime">2018-05-07
      - 2018-05-14</td><td class="mw">27,215 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="odd  8"><td class="dateTime">2018-05-14
      - 2018-05-21</td><td class="mw">26,697 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="even  9"><td class="dateTime">2018-05-21
      - 2018-05-28</td><td class="mw">27,319 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="odd  10"><td class="dateTime">2018-05-28
      - 2018-06-04</td><td class="mw">26,049 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="even  11"><td class="dateTime">2018-06-04
      - 2018-06-11</td><td class="mw">26,461 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="odd  12"><td class="dateTime">2018-06-11
      - 2018-06-18</td><td class="mw">26,014 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="even  13"><td class="dateTime">2018-06-18
      - 2018-06-25</td><td class="mw">26,266 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="odd  14"><td class="dateTime">2018-06-25
      - 2018-07-02</td><td class="mw">26,531 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="even  15"><td class="dateTime">2018-07-02
      - 2018-07-09</td><td class="mw">25,710 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="odd  16"><td class="dateTime">2018-07-09
      - 2018-07-16</td><td class="mw">24,578 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="even  17"><td class="dateTime">2018-07-16
      - 2018-07-23</td><td class="mw">25,148 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="odd  18"><td class="dateTime">2018-07-23
      - 2018-07-30</td><td class="mw">25,115 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="even  19"><td class="dateTime">2018-07-30
      - 2018-08-06</td><td class="mw">25,087 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="odd  20"><td class="dateTime">2018-08-06
      - 2018-08-13</td><td class="mw">25,092 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="even  21"><td class="dateTime">2018-08-13
      - 2018-08-20</td><td class="mw">24,170 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="odd  22"><td class="dateTime">2018-08-20
      - 2018-08-27</td><td class="mw">23,605 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="even  23"><td class="dateTime">2018-08-27
      - 2018-09-03</td><td class="mw">24,053 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="odd  24"><td class="dateTime">2018-09-03
      - 2018-09-10</td><td class="mw">24,882 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="even  25"><td class="dateTime">2018-09-10
      - 2018-09-17</td><td class="mw">23,742 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="odd  26"><td class="dateTime">2018-09-17
      - 2018-09-24</td><td class="mw">21,839 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="even  27"><td class="dateTime">2018-09-24
      - 2018-10-01</td><td class="mw">20,982 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="odd  28"><td class="dateTime">2018-10-01
      - 2018-10-08</td><td class="mw">16,289 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="even  29"><td class="dateTime">2018-10-08
      - 2018-10-15</td><td class="mw">15,406 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="odd  30"><td class="dateTime">2018-10-15</td><td class="mw">15,961 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="even  31"><td class="dateTime">2018-10-16</td><td class="mw">16,887 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="odd  32"><td class="dateTime">2018-10-17</td><td class="mw">13,504 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="even  33"><td class="dateTime">2018-10-18</td><td class="mw">13,525 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="odd  34"><td class="dateTime">2018-10-19</td><td class="mw">14,320 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="even  35"><td class="dateTime">2018-10-20</td><td class="mw">14,721 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="odd  36"><td class="dateTime">2018-10-21</td><td class="mw">14,635 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="even  37"><td class="dateTime">2018-10-22</td><td class="mw">14,111 mWh
        </td><td class="mw">38,000 mWh
        </td></tr><tr class="odd  38"><td class="dateTime">2018-10-23</td><td class="mw">10,614 mWh
        </td><td class="mw">38,000 mWh
        </td></tr></table><h2>
      Battery life estimates
    </h2><div class="explanation2">
      Battery life estimates based on observed drains
    </div><table><colgroup><col/><col class="col2"/><col style="width: 10em;"/><col style=""/><col style="width: 10em;"/><col style="width: 10em;"/><col style="width: 10em;"/></colgroup><thead><tr class="rowHeader"><td> </td><td colspan="2" class="centered">
            AT FULL CHARGE
          </td><td class="colBreak"> </td><td colspan="2" class="centered">
            AT DESIGN CAPACITY
          </td></tr><tr class="rowHeader"><td>
            PERIOD
          </td><td class="centered"><span>ACTIVE</span></td><td class="centered"><span>CONNECTED STANDBY</span></td><td class="colBreak"> </td><td class="centered"><span>ACTIVE</span></td><td class="centered"><span>CONNECTED STANDBY</span></td></tr></thead><tr style="vertical-align:top" class="even  1"><td class="dateTime">2018-03-05
      - 2018-03-12</td><td class="hms">1:58:57</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:40:12</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="odd  2"><td class="dateTime">2018-03-12
      - 2018-04-09</td><td class="hms">1:32:03</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:04:38</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="even  3"><td class="dateTime">2018-04-09
      - 2018-04-16</td><td class="hms">1:54:10</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:34:01</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="odd  4"><td class="dateTime">2018-04-16
      - 2018-04-23</td><td class="hms">1:36:19</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:12:19</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="even  5"><td class="dateTime">2018-04-23
      - 2018-04-30</td><td class="hms">1:32:00</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:08:09</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="odd  6"><td class="dateTime">2018-04-30
      - 2018-05-07</td><td class="hms">1:32:18</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:08:22</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="even  7"><td class="dateTime">2018-05-07
      - 2018-05-14</td><td class="hms">1:35:33</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:13:25</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="odd  8"><td class="dateTime">2018-05-14
      - 2018-05-21</td><td class="hms">1:23:51</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">1:59:22</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="even  9"><td class="dateTime">2018-05-21
      - 2018-05-28</td><td class="hms">1:32:55</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:09:15</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="odd  10"><td class="dateTime">2018-05-28
      - 2018-06-04</td><td class="hms">1:48:06</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:37:42</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="even  11"><td class="dateTime">2018-06-04
      - 2018-06-11</td><td class="hms">1:40:11</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:23:52</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="odd  12"><td class="dateTime">2018-06-11
      - 2018-06-18</td><td class="hms">2:12:10</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">3:13:04</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="even  13"><td class="dateTime">2018-06-18
      - 2018-06-25</td><td class="hms">2:09:48</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">3:07:48</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="odd  14"><td class="dateTime">2018-06-25
      - 2018-07-02</td><td class="hms">1:34:00</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:14:38</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="even  15"><td class="dateTime">2018-07-02
      - 2018-07-09</td><td class="hms">1:40:36</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:28:41</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="odd  16"><td class="dateTime">2018-07-09
      - 2018-07-16</td><td class="hms">1:36:15</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:28:49</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="even  17"><td class="dateTime">2018-07-16
      - 2018-07-23</td><td class="hms">1:39:50</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:30:51</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="odd  18"><td class="dateTime">2018-07-23
      - 2018-07-30</td><td class="hms">1:26:58</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:11:35</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="even  19"><td class="dateTime">2018-07-30
      - 2018-08-06</td><td class="hms">1:21:39</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:03:41</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="odd  20"><td class="dateTime">2018-08-06
      - 2018-08-13</td><td class="hms">1:14:59</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">1:53:34</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="even  21"><td class="dateTime">2018-08-13
      - 2018-08-20</td><td class="hms">1:20:30</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:06:33</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="odd  22"><td class="dateTime">2018-08-20
      - 2018-08-27</td><td class="hms">1:40:29</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:41:47</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="even  23"><td class="dateTime">2018-08-27
      - 2018-09-03</td><td class="hms">1:29:33</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:21:29</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="odd  24"><td class="dateTime">2018-09-03
      - 2018-09-10</td><td class="hms">1:29:20</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:16:27</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="even  25"><td class="dateTime">2018-09-10
      - 2018-09-17</td><td class="hms">1:32:08</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:27:28</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="odd  26"><td class="dateTime">2018-09-17
      - 2018-09-24</td><td class="hms">1:26:44</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:30:56</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="even  27"><td class="dateTime">2018-09-24
      - 2018-10-01</td><td class="hms">1:17:56</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:21:10</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="odd  28"><td class="dateTime">2018-10-01
      - 2018-10-08</td><td class="hms">1:00:59</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:22:16</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="even  29"><td class="dateTime">2018-10-08
      - 2018-10-15</td><td class="hms">0:59:38</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:27:07</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="odd  30"><td class="dateTime">2018-10-15</td><td class="hms">1:09:10</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:44:42</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="even  31"><td class="dateTime">2018-10-16</td><td class="hms">1:31:52</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">3:26:45</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="odd  32"><td class="dateTime">2018-10-17</td><td class="hms">0:42:30</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">1:59:38</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="even  33"><td class="dateTime">2018-10-18</td><td class="hms">1:44:08</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">4:52:35</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="odd  34"><td class="dateTime">2018-10-19</td><td class="hms">0:23:05</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">1:01:17</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="even  35"><td class="dateTime">2018-10-20</td><td class="nullValue">-</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="nullValue">-</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="odd  36"><td class="dateTime">2018-10-21</td><td class="hms">1:03:47</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:45:38</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="even  37"><td class="dateTime">2018-10-22</td><td class="hms">0:48:05</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:09:31</td><td class="nullValue">-</td></tr><tr style="vertical-align:top" class="odd  38"><td class="dateTime">2018-10-23</td><td class="hms">1:18:10</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">4:39:53</td><td class="nullValue">-</td></tr></table><div class="explanation2" style="margin-top: 1em; margin-bottom: 0.4em;">
      Current estimate of battery life based on all observed drains since OS install
    </div><table><colgroup><col/><col class="col2"/><col style="width: 10em;"/><col style=""/><col style="width: 10em;"/><col style="width: 10em;"/><col style="width: 10em;"/></colgroup><tr class="even" style="vertical-align:top"><td>
          Since OS install
        </td><td class="hms">0:41:21</td><td class="nullValue">-</td><td class="colBreak"> </td><td class="hms">2:14:50</td><td class="nullValue">-</td></tr></table><br/><br/><br/></body></html>