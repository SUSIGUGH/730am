pipeline
{
agent any
stages
{

      stage('Build'){
            steps{
	    sh 'ls -ltr'
	    sh 'pwd'
                echo "I am in build"
                sh 'cd docker && docker build -t httptst .'
                sh 'docker image ls | grep httptst'
		sh 'docker run -dit --name httptst01 -p80:80 httptst'
            }
        }

}
}

