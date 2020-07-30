let DrawArea = document.getElementById('drawCanvas');
let ctx = DrawArea.getContext('2d');

class Draw{
	
	ctx;
	constructor(ctx){
		this.ctx = ctx;
	}
	
	rectangle(x, y, height, width, otcolor = "white", bgcolor = "black"){
		this.ctx.beginPath();
		this.ctx.rect(x, y, height, width);
		ctx.fillStyle = otcolor;
		this.ctx.fill();
		ctx.fillStyle = bgcolor;
		this.ctx.stroke();
		this.ctx.closePath();
	}
	
}

let draw = new Draw(ctx);
draw.rectangle();