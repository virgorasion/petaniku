/**
 * Created by Farhad Zaman on 3/11/2017.
 */
const mysql = require('mysql2');
function connection() {
        try {
                let dbSettings={
                        debug: false,
                        host: '127.0.0.1',
                        user: 'root',
                        password: '',
                        database: 'modesy',
                        timezone: 'utc',
                        connectionLimit: 10,
                        waitForConnections: true,
                        queueLimit: 0
                };
                let pool=mysql.createPool(dbSettings);
                return pool.promise();

        } catch (error) {
                return console.log(`Could not connect - ${error}`);
        }
}

const pool = connection();

module.exports={

        query: async (...params) => {
                try{
                       let connection= await pool.getConnection();
                        let [data,e]=await connection.query(...params);
                        await connection.release();
                        return  data;
                }catch (e) {
                        console.log(e)
                }


        },

        execute: async (...params) => {
                try{
                        let connection= await pool.getConnection();
                        let [data,col] =await connection.execute(...params);
                        await connection.release();
                        return  data;
                }catch (e) {
                        console.log(e)
                }

        },


};
