package main

func countUniq(parcels []int) int {

	var res int
	m := make(map[int]bool)

	for _, v := range parcels {
		if _, ok := m[v]; !ok {
			m[v] = true
			res++
		}
	}

	m = nil

	return res
}

func main() {

	println("res:", countUniq([]int{2, 5, 3, 3, 1000, 3}))

	println("___")

	println("res:", countUniq([]int{0, 0, 0}))

	println("___")
}
