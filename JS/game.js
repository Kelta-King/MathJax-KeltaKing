
//mouse constraints
let mouse = Mouse.create(render.canvas);

let mouseConstraints = MouseConstraints.create(engine,{
	
	mouse:mouse,
	constraint:{
		render:{visible: false}
	}
	
});

render.mouse = mouse;

let platform = Matter.Bodies.rectangle(600, 500, 300, 20, { isStatic: true });
let stack = Matter.Composites.stack(500, 270, 4, 4, 0, 0, function(x, y) {
	return Matter.Bodies.polygon(x, y, 8, 30); 
});

let ball = Matter.Bodies.circle(300, 300,20);
let sling = Matter.Constraint.create({ 
      pointA: { x: 300, y: 300 }, 
      bodyB: ball, 
      stiffness: 0.05
  });

let firing = false;
Matter.Events.on(mouseConstraints,'enddrag', function(e) {
  if(e.body === ball) firing = true;
});

Matter.Events.on(engine,'afterUpdate', function() {
  if (firing && Math.abs(ball.position.x-300) < 20 && Math.abs(ball.position.y-600) < 20) {
      ball = Matter.Bodies.circle(300, 600, 20);
      Matter.World.add(engine.world, ball);
      sling.bodyB = ball;
      firing = false;
  }
});

Matter.World.add(engine.world,[platform, stack, ball, sling]);
Matter.Engine.run(engine);
Matter.Render.run(render);