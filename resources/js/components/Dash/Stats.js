import React from 'react'
import axios from 'axios'
import {Bar} from 'react-chartjs-2';

const Stats = () => {
    const URL = `http://localhost/api/aprilsix/dashboard`
    const [data, setData] = React.useState({ chart_data: [] })
    const [worstProduct, setWorstProduct] = React.useState('')
    const [topProduct, setTopProduct] = React.useState('')

    React.useEffect(() => {
        const fetchChartData = () => {
            axios.get(URL)
                .then(res => {
                    setData(res.data.data.chart_data)
                    setWorstProduct(res.data.data.worst_product)
                    setTopProduct(res.data.data.top_product)
                    console.log(data)
                }).catch(e => console.log(e))
        }
        fetchChartData()
    }, [] )

    const state = {
        labels: data.labels,
        datasets: [
            {
                label: 'Products Sold',
                backgroundColor: 'rgba(75,192,192,1)',
                borderColor: 'rgba(0,0,0,1)',
                borderWidth: 2,
                data: data.data
            }
        ]
    }
    return (
        <div>
            <div className='row'>
                <div className="shadow-lg p-3 text-center mb-5 bg-white rounded m-4 w-50">
                    <h3> Top Selling Product </h3>
                    <br/> <br/>
                    {topProduct.part_number}
                    <br/> <br/>
                    <h4> Occurrences </h4>
                    <br/> <br/>
                    {topProduct.occurrences}
                </div>
                <div className="shadow-lg p-3 text-center mb-5 bg-white rounded m-4 w-30">
                    <h3> Worst Selling Product </h3>
                    <br/> <br/>
                    {worstProduct.part_number}
                    <br/> <br/>
                    <h4> Occurrences </h4>
                    <br/> <br/>
                    {worstProduct.occurrences}
                </div>
            </div>
            <Bar
                data={state}
                options={{
                    title:{
                        display:true,
                        text:'',
                        fontSize:20
                    },
                    legend:{
                        display:true,
                        position:'right'
                    }
                }}
            />
        </div>
    )
}

export default Stats
