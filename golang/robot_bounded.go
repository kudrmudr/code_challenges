package main

func isRobotBounded(instructions string) bool {

	x := 0
	y := 0

	vX := 0
	vY := 1

	for _, v := range instructions {

		if string(v) == "G" {
			x = x + vX
			y = y + vY
		} else if string(v) == "L" {
			vX, vY = -vY, vX
		} else {
			vX, vY = vY, -vX
		}
	}

	println(x, y, vX, vY)

	return (x == 0 && y == 0) || vX != 0 || vY != 1
}

func main() {

	println(isRobotBounded("GLLRLGRL"))

	println(isRobotBounded("GGRL"))

	println(isRobotBounded("GL"))

	println(isRobotBounded("GLL"))

	println(isRobotBounded("RLLGLRRRRGGRRRGLLRRR"))
}
