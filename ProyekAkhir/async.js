
function fetchData() {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            console.log('Data fetched');
            // menunggu 2 detik untuk dapat mencetak code dibawah ini
            resolve({ data: 'Some data' });
        }, 2000)
    })
}

function processData(data) {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            console.log('Processing data:', data);
            // menunggu 2 detik untuk dapat mencetak code dibawah ini
            resolve(`Processed: ${data.data}`);
        }, 2000)
    })
}

function saveData(processedData) {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            console.log('Data saved:', processedData);
            // menunggu 2 detik untuk dapat mencetak code dibawah ini
            resolve('Success');
        }, 2000)
    });
}

async function task2(params) { //await hanya dpt digunakan dlm function asyncronous
    try {
        const hasil1 = await fetchData(); // menunggu eksekusi kode function fetchdata() hingga tuntas untuk mencetak hasil1
        const hasil2 = await processData(hasil1);  // menunggu eksekusi kode prosesdata dari hasil1 hingga tuntas untuk mencetak hasil2
        const hasil3 = await saveData(hasil2);  // menunggu eksekusi kode savedata dari hasil2 hingga tuntas untuk mencetak hasil3

        console.log('All operations completed:', hasil3); //mencetak hasil akhir

    } catch (error) {
        console.log("Pesan Error");
    }
}

task2()

// fetchData((fetchErr, fetchedData) => {
//     if (fetchErr) {
//         console.error('Error fetching data:', fetchErr);
//         return;
//     }

//     processData(fetchedData, (processErr, processedData) => {
//         if (processErr) {
//             console.error('Error processing data:', processErr);
//             return;
//         }

//         saveData(processedData, (saveErr, result) => {
//             if (saveErr) {
//                 console.error('Error saving data:', saveErr);
//                 return;
//             }

//             console.log('All operations completed:', result);
//         });
//     });
// });
