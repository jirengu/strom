function Segment() {
    
    var from = {x: 0, y: 0},
        to = {x: 0, y: 0},
        intensity = 1,
        length = 0,
        radians = 0,
        degrees = 0;

    this.getStart = function() {
        return from;
    }

    this.setStart = function(x, y) {
        from = {x: x, y: y};
        this.updateProperties();
    }

    this.getEnd = function() {
        return to;
    }

    this.setEnd = function(x, y) {
        to = {x: x, y: y};
        this.updateProperties();
    }

    this.getRadians = function() {
        return radians;
    }

    this.getDegrees = function() {
        return degrees;
    }

    this.getLength = function() {
        return length;
    }

    this.getIntensity = function() {
        return intensity;
    }

    this.setIntensity = function(value) {
        intensity = value;
    }

    this.updateProperties = function() {
        var dx = to.x - from.x;
        var dy = to.y - from.y;
        length = Math.sqrt(dx * dx + dy * dy);
        radians = Math.atan2(dy, dx);
        degrees = radians * 180 / Math.PI;
    }
    
};