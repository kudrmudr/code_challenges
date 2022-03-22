package main

import (
	"context"
	"math/rand"
	"sync"
	"time"
)

func WorkerForStopping(ctx context.Context, wg *sync.WaitGroup, res chan<- int) {

	interval := rand.Intn(10) + 1

	defer func() {
		println("end", interval)
		wg.Done()
	}()

	println("start", interval)

	ticker := time.NewTicker(time.Duration(interval) * time.Second)

	select {
	case <-ctx.Done():
		return
	case <-ticker.C:
		select {
		case <-ctx.Done():
			return
		case res <- interval:
			return
		}
	}
}

func main() {

	rand.Seed(time.Now().UnixNano())

	resChan := make(chan int)
	ctx, cancel := context.WithCancel(context.Background())
	wg := sync.WaitGroup{}

	for i := 0; i < 5; i++ {
		wg.Add(1)
		go WorkerForStopping(ctx, &wg, resChan)
	}

	result := <-resChan

	println("result", result)

	cancel()

	wg.Wait()

	close(resChan)

}
