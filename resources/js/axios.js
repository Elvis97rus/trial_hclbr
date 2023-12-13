/**
 * Created by Zura on 12/25/2021.
 */
import axios from "axios";

const axiosClient = axios.create({
    baseURL: `/api`
})



export default axiosClient;
