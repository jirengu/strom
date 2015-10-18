function LightningBolt(aContext, aFrom, aTo, aBrightness, aAlpha) {
    
    var _context = aContext,
        from = (aFrom == undefined ? {x: 0, y: 0} : aFrom),
        to = (aTo == undefined ? {x: 0, y: 0} : aTo),
        _brightness = (aBrightness == undefined ? '#ffffff' : aBrightness),
        _alpha = (aAlpha == undefined || isNaN(aAlpha) ? 1 : aAlpha),
        numIterations = 6,
        deviation = 60 + Math.random() * 20,
        branchingProbability = 0.35,//0.5,
        branchAngleMultiplier = 1.2,
        branchScale = 0.9,
        branchIntensityFactor = 0.5,
        _currentOffset = 0,
        _segments;

    this.getStart = function() {
        return from;
    }

    this.setStart = function(x, y) {
        from = {x: x, y: y};
    }

    this.getEnd = function() {
        return to;
    }

    this.setEnd = function(x, y) {
        to = {x: x, y: y};
    }

    this.redraw = function(aAlpha) {

        if (aAlpha != undefined && !isNaN(aAlpha))
        {
            _alpha = aAlpha;
        }
        
        var segment = new Segment();
        segment.setStart(from.x, from.y);
        segment.setEnd(to.x, to.y);
        _segments = [segment];

        this.generate();
        this.render(_alpha);
    }

    this.generate = function() {

        var i = numIterations,
            curSegments,
            segment,
            midPoint,
            offset,
            segmentA,
            segmentB,
            branchAngle,
            branch;

        _currentOffset = deviation;
        while (i--) {
            
            curSegments = _segments.splice(0, _segments.length);
            _segments = [];

            var s = curSegments.length;
            while (s--) {

                segment = curSegments[s];
                
                midPoint = this.interpolate(segment.getStart(), segment.getEnd(), 0.5);
                offset = Math.random() < 0.5 ? _currentOffset : -_currentOffset;

                midPoint.x += Math.cos(segment.getRadians() - 0.25 * Math.PI) * offset;
                midPoint.y += Math.sin(segment.getRadians() - 0.25 * Math.PI) * offset;

                segmentA = new Segment();
                segmentA.setStart(segment.getStart().x, segment.getStart().y);
                segmentA.setEnd(midPoint.x, midPoint.y);
                segmentA.setIntensity(segment.getIntensity());
                segmentB = new Segment(midPoint, segment.getEnd(), segment.getIntensity());
                segmentB.setStart(midPoint.x, midPoint.y);
                segmentB.setEnd(segment.getEnd().x, segment.getEnd().y);
                segmentB.setIntensity(segment.getIntensity());
                _segments.push(segmentA);
                _segments.push(segmentB);

                if (Math.random() < branchingProbability)
                {
                    branchAngle = segmentA.getRadians() * branchAngleMultiplier;
                    branch = new Segment();
                    branch.setStart(midPoint.x, midPoint.y);
                    branch.setEnd(midPoint.x + Math.cos(branchAngle) * branchScale * segmentA.getLength(),
                                  midPoint.y + Math.sin(branchAngle) * branchScale * segmentA.getLength());
                    branch.setIntensity(branchIntensityFactor * segmentA.getIntensity());
                    _segments.push(branch);
                }
            }
            _currentOffset *= 0.5;
        }
    }

    this.render = function(aAlpha) {

        if (aAlpha != undefined && !isNaN(aAlpha))
        {
            _alpha = aAlpha;
        }

        var s = _segments.length;
        
        while (s--) {
            var segment = _segments[s];
            var alpha = segment.getIntensity() * _alpha;
            _context.beginPath();
            _context.moveTo(segment.getStart().x, segment.getStart().y);
            _context.lineTo(segment.getEnd().x, segment.getEnd().y);
            _context.strokeStyle = 'rgba(' + _brightness + ',' + _brightness + ',' + _brightness + ',' + (0.1 * alpha) + ')';
            _context.lineWidth = 6;
            _context.stroke();
            _context.strokeStyle = 'rgba(' + _brightness + ',' + _brightness + ',' + _brightness + ',' + (0.25 * alpha) + ')';
            _context.lineWidth = 4;
            _context.stroke();
            _context.strokeStyle = 'rgba(' + _brightness + ',' + _brightness + ',' + _brightness + ',' + alpha + ')';
            _context.lineWidth = 1;
            _context.stroke();
        }
    }
    
    this.interpolate = function(a, b, factor)
    {
        return {x: a.x + factor * (b.x - a.x), y: a.y + factor * (b.y - a.y)};
    }
};