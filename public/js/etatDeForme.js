/**
 * Created by PC Dell on 08/06/2017.
 */
var etatDeForme = dataForm;

function getPercentage(number, total){
    return number / total * 100;
}


//
// d3.select(".point")
//     .selectAll("div")
//      .data(etatDeForme)
//      .enter().append("div")
//      .style("width", function(d) { return (d.point * 5) +"px"; })
//      .text(function(d) { return d.point; });


bar = d3.selectAll(".point")
    .append("svg")
    .attr("width", 300)
    .attr("height", 15)
    .append("g");

var tooltipPoint = d3.select("body").append("div")
    .attr("class", "tooltipPoint")
    .style("opacity", 0);


etatDeForme.forEach(function (d) {
    // analyse une chaîne de caractère fournie en argument et renvoie un entier exprimé dans une base donnée.
    d.point=parseInt(d.point);

    xScale = d3.scaleLinear()
        .domain([1, (d.d + d.v + d.n)])  // your data minimum and maximum
        .range([1, 100]);

    bar.append("rect")
        .data(etatDeForme)
        .attr("x", 0)
        .attr("y", 0)
        .attr("height", 15)
        .attr("width", function(d) {

            return (d.point * 5) +"px"; })

        .style("fill", "red")
        .on('mouseover', function (d) { // on mouse in show line, circles and text

        tooltipPoint.transition()
            .style("opacity", .9);

//ttotil appear on mouseover with number of points
        tooltipPoint.html(  d.point + " points")
            .style("left", (d3.event.pageX) + "px")   // d3.event.pageX : x coordinate of the page
            .style("top", (d3.event.pageY - 28) + "px");//position div par rappor a la souris

    })
        .on('mouseout', function () { // on mouse out hide line, circles and text
            tooltipPoint.transition()
                .style("opacity", 0);
        });




    bar.append("text")
        .data(etatDeForme)

        .attr("class", "label")
        //y position of the label is halfway down the bar
        //x position is 3 pixels to the right of the bar

        .text(function (d) {
            return d.point;
        })
        .style("fill", "blue");


});


// bar.append("rect")
//      .data(etatDeForme)
//     .attr("height", 15)
//     .attr("width", function(d) { return (d.point * 5) +"px"; })
//     .style("fill", "red");
//     // .text(function(d) { return d.point; });
//
// bar.append("text")
//     .data(etatDeForme)
//
//     .attr("class", "label")
//     //y position of the label is halfway down the bar
//
//     //x position is 3 pixels to the right of the bar
//     .attr("x", function (d) {
//     return (d.point) + 3;
// })
//     .text(function (d) {
//         console.log(d.point);
//         return d.point;
//     });
//
// bar.append("text")
//     .attr("class", "label")
//     //y position of the label is halfway down the bar
//     .attr("y", function (d) {
//         return y(d.name) + y.rangeBand() / 2 + 4;
//     })
//     //x position is 3 pixels to the right of the bar
//     .attr("x", function (d) {
//         return x(d.point) + 3;
//     })
//     .text(function (d) {
//         return d.point;
//         });




vnd = d3.selectAll(".vnd")
    .append("svg")
    .attr("width", 100)
    .attr("height", 15)
    .append("g");

var tooltipPercentage = d3.select("body").append("div")
    .attr("class", "tooltipPercentage")
    .style("opacity", 0);

etatDeForme.forEach(function (d) {
    // analyse une chaîne de caractère fournie en argument et renvoie un entier exprimé dans une base donnée.
    d.d=parseInt(d.d);
    d.n=parseInt(d.n);
    d.v=parseInt(d.v);

    total = d.d + d.v + d.n;

    xScale = d3.scaleLinear()
        .domain([1, total])  // your data minimum and maximum
        .range([1, 100]);

    vnd.append("rect")
        .data(etatDeForme)
        .attr("x", 0)
        .attr("y", 0)
        .attr("height", 15)
        .attr("width", function(d) {

            // console.log(d.v / (d.d + d.v + d.n)*100); // 5/19 pixel trop petit donc on multiplie par 100
            return getPercentage(d.v, total); })
        .style("fill", "green")
        .attr('pointer-events', 'all')
        .on('mouseover', function (d) { // on mouse in show line, circles and text

            tooltipPercentage.transition()
                .style("opacity", .9);

            var percentage1 = getPercentage(d.v, total);

            tooltipPercentage.html(  percentage1.toFixed(2) + " %")
                .style("left", (d3.event.pageX) + "px")   // d3.event.pageX : x coordinate of the page
                .style("top", (d3.event.pageY - 28) + "px");//position div par rappor a la souris

        })
        .on('mouseout', function () { // on mouse out hide line, circles and text
            tooltipPercentage.transition()
                .style("opacity", 0);
        });

    vnd.append("rect")
        .data(etatDeForme)
        .attr("x", function (d) {
            return xScale(d.v);
        })
        .attr("y", 0)
        .attr("height", 15)
        .attr("width", function(d) { return  getPercentage(d.n, total); })
        .style("fill", "yellow")
        .attr('pointer-events', 'all')
        .on('mouseover', function (d) { // on mouse in show line, circles and text

            tooltipPercentage.transition()
                .style("opacity", .9);

            var percentage2 = getPercentage(d.n, total);

            tooltipPercentage.html(  percentage2.toFixed(2) + " %")
                .style("left", (d3.event.pageX) + "px")   // d3.event.pageX : x coordinate of the page
                .style("top", (d3.event.pageY - 28) + "px");//position div par rappor a la souris

        })
        .on('mouseout', function () { // on mouse out hide line, circles and text
            tooltipPercentage.transition()
                .style("opacity", 0);
        });

    vnd.append("rect")
        .data(etatDeForme)
        .attr("x", function (d) {
            return xScale(d.v + d.n);
        })
        .attr("y", 0)
        .attr("height", 15)
        .attr("width", function(d) { return  getPercentage(d.d, total); })
        .style("fill", "red")
        .attr('pointer-events', 'all')
        .on('mouseover', function (d) { // on mouse in show line, circles and text

            tooltipPercentage.transition()
                .style("opacity", .9);

            var percentage3 = getPercentage(d.d, total);

            tooltipPercentage.html(  percentage3.toFixed(2) + " %")
                .style("left", (d3.event.pageX) + "px")   // d3.event.pageX : x coordinate of the page
                .style("top", (d3.event.pageY - 28) + "px");//position div par rappor a la souris

        })
        .on('mouseout', function () { // on mouse out hide line, circles and text
            tooltipPercentage.transition()
                .style("opacity", 0);
        });


});
