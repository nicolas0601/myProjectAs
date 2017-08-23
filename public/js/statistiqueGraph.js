/**
 * Created by PC Dell on 08/08/2017.
 */
var statGraph = graphWin;
 console.log(statGraph);
function getPercentage(number, total){
    return number / total * 100;
}


var width = 200,
    height = 130,
    radius = Math.min(width, height) / 2;

var color = d3.scaleOrdinal()
    .range(["#008080", "#D3D3D3", "dodgerblue"]);

var arc = d3.arc()
    .outerRadius(radius - 10)
    .innerRadius(0);

var labelArc = d3.arc()
    .outerRadius(radius - 40)
    .innerRadius(radius - 40);

var pie = d3.pie()
    .sort(null)
    .value(function(d) { return d; });

var svg = d3.select(".divStat").append("svg")
    .attr("width", width)
    .attr("height", height)
    .append("g")
    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

var g = svg.selectAll(".arc")
    .data(pie(statGraph))
    .enter().append("g")
    .attr("class", "arc");

g.append("path")
    .attr("d", arc)
    .style("fill", function(d) { return color(d.index); });


var total= d3.sum(statGraph, function(d){return d.value;});
console.log(total);
// var toPercent = d3.format("0.1%");

g.append("text")
    .attr("transform", function(d) { return "translate(" + labelArc.centroid(d) + ")"; })
    .attr("dy", ".35em")
    .text(function(d) {  return d.value; });