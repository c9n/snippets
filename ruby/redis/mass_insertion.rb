def gen_redis_proto (cmd)
    proto = ''
    proto << '*' + cmd.length.to_s + "\r\n"

    cmd.each{ |arg|
        proto << '$' + arg.to_s.bytesize.to_s + "\r\n"
        proto << arg.to_s + "\r\n"
    }

    proto
end

Dir.glob('data/*.txt') do | file |

    File.foreach(file).with_index { |line, line_num|
        keyword = line.split("\t", 2)[0].gsub('+', ' ').strip
        values = line.split("\t", 2)[1].strip.split("\t", 2)[1]

        STDOUT.write(gen_redis_proto(["RPUSH", "ms:#{keyword}"].concat values.split("\t")))
    }

end
