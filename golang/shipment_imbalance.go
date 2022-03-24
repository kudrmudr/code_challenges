package main

//O(N^2) solution
func imbalance(weights []int) int {
	var res int
	l := len(weights)

	for i, vi := range weights {

		min := vi
		max := 0
		for j := i; j < l; j++ {
			vj := weights[j]

			if vj > max {
				max = vj
			}

			if vj < min {
				min = vj
			}

			res = res + max - min
		}
	}

	return res
}

func main() {

	println("res:", imbalance([]int{1, 2, 3}))

	println("___")

	println("res:", imbalance([]int{3, 2, 3}))

	println("___")

	println("res:", imbalance([]int{1, 8, 2, 1}))
}
