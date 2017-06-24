/**
 * Created by PC Dell on 08/06/2017.
 */
var etatDeForme = dataForm;


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

        .style("fill", "red");




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

etatDeForme.forEach(function (d) {
   // analyse une chaîne de caractère fournie en argument et renvoie un entier exprimé dans une base donnée.
    d.d=parseInt(d.d);
    d.n=parseInt(d.n);
    d.v=parseInt(d.v);

    xScale = d3.scaleLinear()
        .domain([1, (d.d + d.v + d.n)])  // your data minimum and maximum
        .range([1, 100]);

    vnd.append("rect")
        .data(etatDeForme)
        .attr("x", 0)
        .attr("y", 0)
        .attr("height", 15)
        .attr("width", function(d) {

//5/19 pixel trop petit donc on multiplie par 100
            console.log(d.v *100 / (d.d + d.v + d.n));
            console.log(d.v );
            console.log(+parseInt(d.d) + d.v + d.n);
            // console.log(d.v / (d.d + d.v + d.n)*100);
            return d.v / (d.d + d.v + d.n)*100 ; })
        .style("fill", "green");

    vnd.append("rect")
        .data(etatDeForme)
        .attr("x", function (d) {
            return xScale(d.v);
        })
        .attr("y", 0)
        .attr("height", 15)
        .attr("width", function(d) { return  (d.n / (d.d + d.v + d.n))*100; })
        .style("fill", "yellow");

    vnd.append("rect")
        .data(etatDeForme)
        .attr("x", function (d) {
            return xScale(d.v + d.n);
        })
        .attr("y", 0)
        .attr("height", 15)
        .attr("width", function(d) { return (d.d / (d.d + d.v + d.n))*100; })
        .style("fill", "red");


});





