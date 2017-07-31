var journe1 = journee; //38
var titre1 = "Comparaison de classement";
var dataEq1 = dataGraph; // 3 data
var nbrEquipe1 = nbEquipe; //20 y axis

var margin = {top: 30, right: 20, bottom: 30, left: 50},
    width = 800 - margin.left - margin.right,
    height = 600 - margin.top - margin.bottom;

graphCLassement(".data", titre1, height, width, journe1,dataEq1, nbrEquipe1 );

function graphCLassement(data, titre, height, width, journe, dataEq, nbrEquipe) {


//definir les axes
    var xScale = d3.scaleLinear()
        .domain([1, 38])  // your data minimum and maximum
        .range([1, width]); // the pixels to map to, e.g., the width of the diagram.

    var yScale = d3.scaleLinear()
        .domain([1, nbrEquipe])
        .range([1, height]);

//position des axes

    var xAxis = d3.axisBottom(xScale)
        .ticks(journe);

    var yAxis = d3.axisLeft(yScale)
        .ticks(nbrEquipe);

// console.log(data);

    var valueline = d3.line()
        .x(function (d) {
            return xScale(d.journee);
        })
        .y(function (d) {
            return yScale(d.rang_eq1);
        });


    var valueline2 = d3.line()
        .x(function (d) {
            return xScale(d.journee);
        })
        .y(function (d) {
            return yScale(d.rang_eq2);
        });

//ajout de la barre verticale

    var canvas = d3.select(data)
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left
            + "," + margin.top + ")");

// On importe les données
    console.log(dataEq);
    dataEq.forEach(function (d) {

        d.journee = +parseInt(d.journee);
        d.rang_eq1 = +parseInt(d.rang_eq1);
        d.rang_eq2 = +parseInt(d.rang_eq2);

    });
// console.log(rang_eq2);

// On appelle ici la fonction valueline,qui donne des coordonnées à relier à la ligne.
    canvas.append("path")
        .data(dataEq)
        .attr("class", "line")
        .style("stroke", "yellow")
        .attr("d", valueline(dataEq));

    canvas.append("path")
        .data(dataEq)
        .attr("class", "line")
        .style("stroke", "purple")
        .attr("d", valueline2(dataEq));

//creer les points de liaison entre les données et affichage avec la souris

    canvas.append("g")         // ajoute X Axis
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height + ")")
        .call(xAxis);

    canvas.append("g")         // ajoute  Y Axis
        .attr("class", "y axis")
        .call(yAxis);

    canvas.append("g")
        .selectAll("dot")
        .data(dataEq)
        .enter().append("circle")
        .attr("r", 5)
        .style("fill", "purple")

        .attr("cx", function (d) {
            return xScale(d.journee);
        })
        .attr("cy", function (d) {
            return yScale(d.rang_eq2);
        });

    canvas.append("g").selectAll("dot")
        .data(dataEq)
        .enter().append("circle")
        .attr("r", 5)
        .style("fill", "yellow")
        .attr("cx", function (d) {
            return xScale(d.journee);
        })
        .attr("cy", function (d) {
            return yScale(d.rang_eq1);
        });

//titre du graph
    canvas.append("text")
        .attr("x", (width / 2))
        .attr("y", 0 - (margin.top / 2))
        .attr("text-anchor", "middle")
        .style("font-size", "20px")
        .style("fill", " #FFCB1A")
        .style("text-decoration", "underline")
        .text(titre);

    var tooltipDiffClass = d3.select("body").append("div")
        .attr("class", "tooltipDiffClass")
        .style("opacity", 0);


    var lines = document.getElementsByClassName('line');


    var mouseG = canvas.append("g")
        .attr("class", "mouse-over-effects");

//ligne verticale ??
    mouseG.append("path")
    // .enter().append("text")
        .attr("class", "mouse-line")
        .style("stroke", "blue")
        .style("stroke-width", "1px")
        .style("opacity", "0");

    var mousePerLine = mouseG.selectAll('.mouse-per-line')
        .data(lines)
        .enter()
        .append("g")
        .attr("class", "mouse-per-line"); // 19 lines


//barres horizontale
    mousePerLine.append("rect")
        .attr("x", -width)
        .attr("y", 0)
        .attr("height", 1)
        .attr("width", width + 2000)
        .style("stroke", "red")
        .style("fill", "none")
        // .style("stroke-width", "1px")
        .style("opacity", "0");

    mousePerLine.append("text")
        .attr("transform", "translate(10,3)");


    mouseG.append('rect') // append a rect to catch mouse movements on canvas
        .data(dataEq)
        .attr('width', width)
        .attr('height', height)
        .attr('fill', 'none')
        .attr('pointer-events', 'all')
        .on('mouseout', function () { // on mouse out hide line, circles and text
            d3.select(".mouse-line")
                .style("opacity", 0);
            d3.selectAll(".mouse-per-line rect")
                .style("opacity", 0);
            d3.selectAll(".mouse-per-line text")
                .style("opacity", 0);
            tooltipDiffClass.transition()
                .style("opacity", 0);
        })
        .on('mouseover', function () { // on mouse in show line, circles and text
            d3.select(".mouse-line")
                .style("opacity", "1");
            // d3.select(".tooltipDiffClass")
            //     .style("opacity", "1");
            d3.selectAll(".mouse-per-line rect")
                .style("opacity", "1");
            d3.selectAll(".mouse-per-line text")
                .style("opacity", "1");
        })
        .on('mousemove', function () { // mouse moving over canvas

            var mouse = d3.mouse(this);
            d3.select(".mouse-line")
                .attr("d", function () {
                    var d = "M" + mouse[0] + "," + height;
                    d += " " + mouse[0] + "," + 0;
                    return d;
                });
            tooltipDiffClass.transition()
                .style("opacity", .9);

            function getDiff() {

                dataDisplay = dataEq.find(function (data) {

                    return data.journee === +xScale.invert(mouse[0]).toFixed();
                });

                console.log(dataDisplay);

                return Math.abs(dataDisplay.rang_eq1 - dataDisplay.rang_eq2);//return différence de place (match.abs = tjs positif)
            }

            // transition ??
            tooltipDiffClass.html("Delta " + getDiff())
                .style("left", (d3.event.pageX) + "px")   // d3.event.pageX : x coordinate of the page
                .style("top", (d3.event.pageY - 28) + "px");//position div par rappor a la souris


            d3.selectAll(".mouse-per-line")
                .attr("transform", function (d, i) {

                    var beginning = 0,
                        end = lines[i].getTotalLength(),
                        target = null;

                    while (true) {
                        target = Math.round((beginning + end) / 2); // midpoint
                        pos = lines[i].getPointAtLength(target);

                        if ((target === end || target === beginning) && pos.x !== mouse[0]) {
                            break;
                        }
                        if (pos.x > mouse[0]) end = target;
                        else if (pos.x < mouse[0]) beginning = target;
                        else break; //position found
                    }

                    d3.select(this).select('text')
                        .text(yScale.invert(pos.y).toFixed());

                    return "translate(" + mouse[0] + "," + pos.y + ")";
                });


        });
}
