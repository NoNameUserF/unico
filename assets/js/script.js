// // function bs(arr, target) {
// //   let left = 0;
// //   let right = arr.length - 1;

// //   while (left <= right) {
// //     let mod = Math.floor((left + right) / 2);

// //     if (arr[mod] === target) {
// //       return mod;
// //     }

// //     if (arr[mod] > target) {
// //       right = mod - 1;
// //     } else {
// //       left = mod + 1;
// //     }
// //   }
// //   return -1;
// // }

// // console.log(bs([1, 2, 3, 4, 5], 4));
// const states = {
//   IDLE: 'IDLE',
//   REQUESTING: 'REQUESTING',
//   PROCESSING: 'PROCESSING',
//   DELIVERED: 'DELIVERED',
//   ERROR: 'ERROR',
// };

// const stateMachine = {
//   [states.IDLE]: {
//     idle: states.IDLE,
//   },
//   [states.REQUESTING]: {
//     request: states.REQUESTING,
//   },
//   [states.IDLE]: {
//     idle: states.IDLE,
//   },
//   [states.IDLE]: {
//     idle: states.IDLE,
//   },
// };

// class Machine {
//   constructor() {
//     this.state = states.IDLE;
//   }
// }

function qs(arr) {
  if (arr.length < 2) {
    return arr;
  }
  let pivot = arr[arr.length - 1];

  let left = [];
  let right = [];

  for (let i = 0; i < arr.length - 1; i++) {
    if (arr[i] < pivot) {
      left.push(arr[i]);
    } else {
      right.push(arr[i]);
    }
  }

  return [...qs(left), pivot, ...qs(right)];
}

console.log(qs([123, 3, 2, 5, 0, -100, -19]));

const obj = {
  name: 'alex',
  age: 123,
};

const test = Object.entries(obj);

const res = {
  ...Object.fromEntries(test),
  name: 'HI',
};

console.log(res);
